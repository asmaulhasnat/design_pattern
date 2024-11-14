<?php
/*
The Builder Pattern is a creational design pattern that separates the construction of a complex object from its representation, allowing the same construction process to create different representations. 
This pattern is especially useful when you need to create complex objects with many optional parameters or configurations.

In PHP, let’s implement the Builder Pattern by creating an example of a House class with multiple optional parts, like walls, doors, windows, and a roof.
We’ll use the Builder Pattern to allow clients to construct a house by specifying only the parts they need.
*/



class House {
    private $walls;
    private $doors;
    private $windows;
    private $roof;
    private $garage;

    public function setWalls(string $walls): void {
        $this->walls = $walls;
    }

    public function setDoors(string $doors): void {
        $this->doors = $doors;
    }

    public function setWindows(string $windows): void {
        $this->windows = $windows;
    }

    public function setRoof(string $roof): void {
        $this->roof = $roof;
    }

    public function setGarage(string $garage): void {
        $this->garage = $garage;
    }

    public function showSpecifications(): void {
        echo "House Specifications:\n";
        echo "Walls: " . ($this->walls ?? "None") . "\n";
        echo "Doors: " . ($this->doors ?? "None") . "\n";
        echo "Windows: " . ($this->windows ?? "None") . "\n";
        echo "Roof: " . ($this->roof ?? "None") . "\n";
        echo "Garage: " . ($this->garage ?? "None") . "\n";
    }
}


interface HouseBuilder {
    public function buildWalls(): void;
    public function buildDoors(): void;
    public function buildWindows(): void;
    public function buildRoof(): void;
    public function buildGarage(): void;
    public function getHouse(): House;
}


class LuxuryHouseBuilder implements HouseBuilder {
    private $house;

    public function __construct() {
        $this->house = new House();
    }

    public function buildWalls(): void {
        $this->house->setWalls("Luxury Walls");
    }

    public function buildDoors(): void {
        $this->house->setDoors("Luxury Doors");
    }

    public function buildWindows(): void {
        $this->house->setWindows("Large Windows");
    }

    public function buildRoof(): void {
        $this->house->setRoof("High-End Roof");
    }

    public function buildGarage(): void {
        $this->house->setGarage("Spacious Garage");
    }

    public function getHouse(): House {
        return $this->house;
    }
}

class SimpleHouseBuilder implements HouseBuilder {
    private $house;

    public function __construct() {
        $this->house = new House();
    }

    public function buildWalls(): void {
        $this->house->setWalls("Simple Walls");
    }

    public function buildDoors(): void {
        $this->house->setDoors("Basic Doors");
    }

    public function buildWindows(): void {
        $this->house->setWindows("Standard Windows");
    }

    public function buildRoof(): void {
        $this->house->setRoof("Simple Roof");
    }

    public function buildGarage(): void {
        // No garage for a simple house
    }

    public function getHouse(): House {
        return $this->house;
    }
}


class HouseDirector {
    private $builder;

    public function __construct(HouseBuilder $builder) {
        $this->builder = $builder;
    }

    public function buildHouse(): House {
        $this->builder->buildWalls();
        $this->builder->buildDoors();
        $this->builder->buildWindows();
        $this->builder->buildRoof();
        $this->builder->buildGarage();
        return $this->builder->getHouse();
    }
}



$luxuryBuilder = new LuxuryHouseBuilder();
$director = new HouseDirector($luxuryBuilder);
$luxuryHouse = $director->buildHouse();
$luxuryHouse->showSpecifications();  // Displays the specifications of a luxury house

echo "\n";

// Create a simple house
$simpleBuilder = new SimpleHouseBuilder();
$director = new HouseDirector($simpleBuilder);
$simpleHouse = $director->buildHouse();
$simpleHouse->showSpecifications();  // Displays the specifications of a simple house