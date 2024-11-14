<?php

interface Component {
    public function showDetails(): void;
    public function add(Component $component): void;
    public function remove(Component $component): void;
}



class File implements Component {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function showDetails(): void {
        echo "File: " . $this->name . "\n";
    }

    // Files cannot contain other components, so these methods are not implemented.
    public function add(Component $component): void {
        throw new Exception("Cannot add to a file.");
    }

    public function remove(Component $component): void {
        throw new Exception("Cannot remove from a file.");
    }
}



class Folder implements Component {
    private $name;
    private $children = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function showDetails(): void {
        echo "Folder: " . $this->name . "\n";
        foreach ($this->children as $child) {
            echo "- ";
            $child->showDetails();
        }
    }

    public function add(Component $component): void {
        $this->children[] = $component;
    }

    public function remove(Component $component): void {
        $index = array_search($component, $this->children, true);
        if ($index !== false) {
            unset($this->children[$index]);
        }
    }
}



// Create files
$file1 = new File("File1.txt");
$file2 = new File("File2.txt");
$file3 = new File("File3.txt");

// Create folders
$folder1 = new Folder("Folder1");
$folder2 = new Folder("Folder2");
$rootFolder = new Folder("RootFolder");

// Build the hierarchy
$folder1->add($file1);       // Add File1 to Folder1
$folder1->add($file2);       // Add File2 to Folder1
$folder2->add($file3);       // Add File3 to Folder2
$rootFolder->add($folder1);  // Add Folder1 to RootFolder
$rootFolder->add($folder2);  // Add Folder2 to RootFolder

// Display the file structure
$rootFolder->showDetails();

