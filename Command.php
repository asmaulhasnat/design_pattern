<?php

/**
 * The Command Pattern is a behavioral design pattern that turns a request into a stand-alone object,
 * which can then be stored, passed around, and executed independently. 
 * The Command Pattern encapsulates a request as an object, thus allowing for parameterization of clients with queues, requests, or operations.
 */

interface Command {
    public function execute(): void;
}


class Light {
    public function turnOn(): void {
        echo "The light is ON\n";
    }

    public function turnOff(): void {
        echo "The light is OFF\n";
    }
}

class Fan {
    public function start(): void {
        echo "The fan is spinning\n";
    }

    public function stop(): void {
        echo "The fan has stopped\n";
    }
}




class LightOnCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute(): void {
        $this->light->turnOn();
    }
}

class LightOffCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute(): void {
        $this->light->turnOff();
    }
}

class FanStartCommand implements Command {
    private $fan;

    public function __construct(Fan $fan) {
        $this->fan = $fan;
    }

    public function execute(): void {
        $this->fan->start();
    }
}

class FanStopCommand implements Command {
    private $fan;

    public function __construct(Fan $fan) {
        $this->fan = $fan;
    }

    public function execute(): void {
        $this->fan->stop();
    }
}




class RemoteControler {
    private $command;

    public function setCommand(Command $command): void {
        $this->command = $command;
    }

    public function pressButton(): void {
        $this->command->execute();
    }
}





// Receivers
$light = new Light();
$fan = new Fan();

// Commands
$lightOn = new LightOnCommand($light);
$lightOff = new LightOffCommand($light);
$fanStart = new FanStartCommand($fan);
$fanStop = new FanStopCommand($fan);

// Invoker
$remote = new RemoteControler();

// Turn on the light
$remote->setCommand($lightOn);
$remote->pressButton(); // Output: The light is ON

// Turn off the light
$remote->setCommand($lightOff);
$remote->pressButton(); // Output: The light is OFF

// Start the fan
$remote->setCommand($fanStart);
$remote->pressButton(); // Output: The fan is spinning

// Stop the fan
$remote->setCommand($fanStop);
$remote->pressButton(); // Output: The fan has stopped


