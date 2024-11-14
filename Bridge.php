<?php
/**
 * The Bridge Pattern is a structural design pattern that decouples an abstraction from its implementation, allowing them to vary independently. 
 * This pattern is useful when both the abstraction (what the object does) and the implementation (how it does it) may have multiple variations, and you want to separate them to improve flexibility, scalability, and maintainability.
 */

interface Device {
    public function powerOn(): void;
    public function powerOff(): void;
    public function setVolume(int $volume): void;
}




class TV implements Device {
    private $volume = 10;

    public function powerOn(): void {
        echo "TV is now ON\n";
    }

    public function powerOff(): void {
        echo "TV is now OFF\n";
    }

    public function setVolume(int $volume): void {
        $this->volume = $volume;
        echo "TV volume set to " . $this->volume . "\n";
    }
}

class Radio implements Device {
    private $volume = 5;

    public function powerOn(): void {
        echo "Radio is now ON\n";
    }

    public function powerOff(): void {
        echo "Radio is now OFF\n";
    }

    public function setVolume(int $volume): void {
        $this->volume = $volume;
        echo "Radio volume set to " . $this->volume . "\n";
    }
}



class RemoteControl {
    protected $device;

    public function __construct(Device $device) {
        $this->device = $device;
    }

    public function togglePower(): void {
        echo "Toggling power...\n";
        if (rand(0, 1)) {
            $this->device->powerOn();
        } else {
            $this->device->powerOff();
        }
    }

    public function volumeUp(): void {
        $this->device->setVolume(rand(11, 20));
    }

    public function volumeDown(): void {
        $this->device->setVolume(rand(0, 10));
    }
}



class AdvancedRemoteControl extends RemoteControl {
    public function mute(): void {
        echo "Muting the device\n";
        $this->device->setVolume(0);
    }
}


// Control the TV with a basic remote
$tv = new TV();
$remoteControl = new RemoteControl($tv);
$remoteControl->togglePower();
$remoteControl->volumeUp();
$remoteControl->volumeDown();

echo "\n";

// Control the Radio with an advanced remote
$radio = new Radio();
$advancedRemoteControl = new AdvancedRemoteControl($radio);
$advancedRemoteControl->togglePower();
$advancedRemoteControl->volumeUp();
$advancedRemoteControl->mute();



