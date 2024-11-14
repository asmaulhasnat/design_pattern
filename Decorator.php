<?php

/**
 * The Decorator Pattern is a structural design pattern that allows you to add new functionality to an object dynamically without altering its structure.
 * This pattern wraps an object within other objects that add additional behaviors, creating a flexible and reusable alternative to subclassing.
 */

interface Coffee {
    public function getCost(): float;
    public function getDescription(): string;
}


class SimpleCoffee implements Coffee {
    public function getCost(): float {
        return 5.00;
    }

    public function getDescription(): string {
        return "Simple Coffee";
    }
}


class CoffeeDecorator implements Coffee {
    protected $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function getCost(): float {
        return $this->coffee->getCost();
    }

    public function getDescription(): string {
        return $this->coffee->getDescription();
    }
}

class MilkDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return $this->coffee->getCost() + 1.50;
    }

    public function getDescription(): string {
        return $this->coffee->getDescription() . ", Milk";
    }
}

class SugarDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return $this->coffee->getCost() + 0.50;
    }

    public function getDescription(): string {
        return $this->coffee->getDescription() . ", Sugar";
    }
}

class WhippedCreamDecorator extends CoffeeDecorator {
    public function getCost(): float {
        return $this->coffee->getCost() + 2.00;
    }

    public function getDescription(): string {
        return $this->coffee->getDescription() . ", Whipped Cream";
    }
}


// Create a simple coffee
$coffee = new SimpleCoffee();
echo $coffee->getDescription() . " | Cost: $" . $coffee->getCost() . "\n";

// Add milk
$coffee = new MilkDecorator($coffee);
echo $coffee->getDescription() . " | Cost: $" . $coffee->getCost() . "\n";

// Add sugar
$coffee = new SugarDecorator($coffee);
echo $coffee->getDescription() . " | Cost: $" . $coffee->getCost() . "\n";

// Add whipped cream
$coffee = new WhippedCreamDecorator($coffee);
echo $coffee->getDescription() . " | Cost: $" . $coffee->getCost() . "\n";