<?php
/**
 * The Visitor Pattern is a behavioral design pattern that lets you add further operations to objects without modifying their structure.
 * It allows separating an algorithm from the objects on which it operates,
 * making it particularly useful for scenarios where you need to perform various unrelated operations on a group of objects without changing their classes.
 * This is achieved by adding a Visitor object that "visits" each element in the object structure and performs a specific operation.
 */


 interface ShapeVisitor {
     public function visitCircle(Circle $circle): void;
     public function visitRectangle(Rectangle $rectangle): void;
 }
 


interface Shape {
    public function accept(ShapeVisitor $visitor): void;
}



class Circle implements Shape {
    private $radius;

    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    public function getRadius(): float {
        return $this->radius;
    }

    public function accept(ShapeVisitor $visitor): void {
        $visitor->visitCircle($this);
    }
}




class Rectangle implements Shape {
    private $width;
    private $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float {
        return $this->width;
    }

    public function getHeight(): float {
        return $this->height;
    }

    public function accept(ShapeVisitor $visitor): void {
        $visitor->visitRectangle($this);
    }
}


class AreaVisitor implements ShapeVisitor {
    public function visitCircle(Circle $circle): void {
        $area = pi() * pow($circle->getRadius(), 2);
        echo "Area of Circle: " . $area . "\n";
    }

    public function visitRectangle(Rectangle $rectangle): void {
        $area = $rectangle->getWidth() * $rectangle->getHeight();
        echo "Area of Rectangle: " . $area . "\n";
    }
}



class PerimeterVisitor implements ShapeVisitor {
    public function visitCircle(Circle $circle): void {
        $perimeter = 2 * pi() * $circle->getRadius();
        echo "Perimeter of Circle: " . $perimeter . "\n";
    }

    public function visitRectangle(Rectangle $rectangle): void {
        $perimeter = 2 * ($rectangle->getWidth() + $rectangle->getHeight());
        echo "Perimeter of Rectangle: " . $perimeter . "\n";
    }
}



// Create shapes
$circle = new Circle(5);
$rectangle = new Rectangle(4, 6);

// Create visitors
$areaVisitor = new AreaVisitor();
$perimeterVisitor = new PerimeterVisitor();

// Calculate area
$circle->accept($areaVisitor); // Output: Area of Circle: 78.53981633974483
$rectangle->accept($areaVisitor); // Output: Area of Rectangle: 24

// Calculate perimeter
$circle->accept($perimeterVisitor); // Output: Perimeter of Circle: 31.41592653589793
$rectangle->accept($perimeterVisitor); // Output: Perimeter of Rectangle: 20




