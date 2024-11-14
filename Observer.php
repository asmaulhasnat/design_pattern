<?php
/*
  The Observer Pattern is a behavioral design pattern that defines a one-to-many relationship between objects,
  so that when one object (the "subject") changes state, all its dependent objects (the "observers") are notified and updated automatically.
  This pattern is commonly used to implement distributed event-handling systems.
 */

interface Observer {
    public function update(float $temperature): void;
}




interface Subject {
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(): void;
}



class WeatherStation implements Subject {
    private $observers = [];
    private $temperature;

    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void {
        $this->observers = array_filter(
            $this->observers,
            function ($obs) use ($observer) {
                return $obs !== $observer;
            }
        );
    }

    public function setTemperature(float $temperature): void {
        $this->temperature = $temperature;
        $this->notify();
    }

    public function notify(): void {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature);
        }
    }
}



class PhoneDisplay implements Observer {
    private $temperature;

    public function update(float $temperature): void {
        $this->temperature = $temperature;
        echo "Phone Display: Temperature updated to " . $this->temperature . "°C\n";
    }
}

class WindowDisplay implements Observer {
    private $temperature;

    public function update(float $temperature): void {
        $this->temperature = $temperature;
        echo "Window Display: Temperature updated to " . $this->temperature . "°C\n";
    }
}




// Create weather station (subject)
$weatherStation = new WeatherStation();

// Create displays (observers)
$phoneDisplay = new PhoneDisplay();
$windowDisplay = new WindowDisplay();

// Attach displays to the weather station
$weatherStation->attach($phoneDisplay);
$weatherStation->attach($windowDisplay);

// Change temperature
$weatherStation->setTemperature(25.0); // Both displays are notified
$weatherStation->setTemperature(30.0); // Both displays are notified

// Detach one display
$weatherStation->detach($phoneDisplay);
$weatherStation->setTemperature(28.0); // Only the window display is notified


