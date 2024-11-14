<?php

/*
The Prototype Pattern is a creational design pattern used to create new objects by copying an existing object, known as the prototype. Instead of instantiating a new object from scratch, the prototype object is cloned, which can be faster and more efficient, especially when creating complex or resource-intensive objects.

This pattern is particularly useful when:

Object creation is expensive or resource-intensive.
You need a large number of similar objects with minor differences.
You want to avoid subclasses to create a variety of related objects.
 */

interface Prototype {
    public function clone(): Prototype;
}




class Document implements Prototype {
    private $title;
    private $content;
    private $footer;

    public function __construct(string $title, string $content, string $footer) {
        $this->title = $title;
        $this->content = $content;
        $this->footer = $footer;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setFooter(string $footer): void {
        $this->footer = $footer;
    }

    public function display(): void {
        echo "Title: " . $this->title . "\n";
        echo "Content: " . $this->content . "\n";
        echo "Footer: " . $this->footer . "\n";
    }

    public function clone(): Prototype {
        // Create a shallow copy of the object
        return clone $this;
    }
}




// Create an initial document prototype
$originalDocument = new Document("Prototype Pattern", "This is a document about the Prototype Pattern.", "Confidential");

// Display the original document
echo "Original Document:\n";
$originalDocument->display();

echo "\n";

// Clone the original document to create a new document and modify it
$clonedDocument = $originalDocument->clone();
$clonedDocument->setTitle("Prototype Pattern - Cloned Version");
$clonedDocument->setFooter("Public");

// Display the cloned document with modifications
echo "Cloned Document:\n";
$clonedDocument->display();
