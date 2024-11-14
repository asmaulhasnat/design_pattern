<?php
/**
 * The Flyweight Pattern is a structural design pattern focused on minimizing memory usage by sharing as much data as possible between similar objects.
 * Instead of creating multiple instances of the same data, the Flyweight Pattern reuses objects to avoid redundancy.
 * It is particularly useful in situations where there are a large number of similar objects, such as text editors, game development, or GUIs.


 */

class TreeType {
    private $name;
    private $color;
    private $texture;

    public function __construct(string $name, string $color, string $texture) {
        $this->name = $name;
        $this->color = $color;
        $this->texture = $texture;
    }

    public function draw(int $x, int $y): void {
        echo "Drawing a {$this->name} tree of color {$this->color} and texture {$this->texture} at ($x, $y).\n";
    }
}


class TreeFactory {
    private static $treeTypes = [];

    public static function getTreeType(string $name, string $color, string $texture): TreeType {
        $key = md5($name . $color . $texture);
        if (!isset(self::$treeTypes[$key])) {
            self::$treeTypes[$key] = new TreeType($name, $color, $texture);
        }
        return self::$treeTypes[$key];
    }
}


class Tree {
    private $x;
    private $y;
    private $type;

    public function __construct(int $x, int $y, TreeType $type) {
        $this->x = $x;
        $this->y = $y;
        $this->type = $type;
    }

    public function draw(): void {
        $this->type->draw($this->x, $this->y);
    }
}



class Forest {
    private $trees = [];

    public function plantTree(int $x, int $y, string $name, string $color, string $texture): void {
        $type = TreeFactory::getTreeType($name, $color, $texture);
        $tree = new Tree($x, $y, $type);
        $this->trees[] = $tree;
    }

    public function draw(): void {
        foreach ($this->trees as $tree) {
            $tree->draw();
        }
    }
}

// Create a forest and plant trees
$forest = new Forest();
$forest->plantTree(1, 1, "Oak", "Green", "Rough");
$forest->plantTree(2, 3, "Pine", "Dark Green", "Smooth");
$forest->plantTree(5, 2, "Oak", "Green", "Rough");  // Reuses the Oak type
$forest->plantTree(4, 4, "Birch", "Light Green", "Thin");

$forest->draw();



