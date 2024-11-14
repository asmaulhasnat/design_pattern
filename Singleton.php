<?php
/*
1. Basic Structure of a Singleton Class in PHP
    A Singleton class must:

    #Have a private static variable to hold the single instance of the class.
    #Have a private constructor to prevent direct instantiation.
    #Have a public static method to access the instance, which will create the instance if it does not exist.

*/



class Singleton {
    // Hold the class instance.
    private static $instance = null;

    // The constructor is private to prevent initiation with `new`.
    private function __construct() {
        // Initialize any necessary resources here.
        echo "Initializing resources...\n";
    }

    // Prevent the instance from being cloned (which would create a second instance).
    private function __clone() { }

    // Prevent from being unserialized (which would create a second instance).
    public function __wakeup() { }

    // Method to retrieve the single instance of the class.
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    // Example of a method that can be called on the singleton instance.
    public function doSomething() {
        echo "Doing something with the singleton instance.\n";
    }
}

// Usage
$instance1 = Singleton::getInstance();
$instance1->doSomething();

// Attempting to create another instance
$instance2 = Singleton::getInstance();

// Checking if both instances are indeed the same
if ($instance1 === $instance2) {
    echo "Both instances are the same.";
}



/*
Explanation of Key Parts
Private Constructor:

private function __construct() { }
This ensures the class can’t be instantiated from outside, enforcing a single instance.
Static getInstance() Method:

public static function getInstance()
This method checks if an instance already exists. If it doesn’t, it creates one and stores it in self::$instance. It then returns the single instance.
Preventing Cloning and Unserialization:

The private __clone() and __wakeup() methods prevent duplication through cloning or unserialization.
*/
?>