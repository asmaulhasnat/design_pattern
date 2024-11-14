<?php
/**
 * The Facade Pattern is a structural design pattern that provides a simplified interface to a complex system of classes, libraries, or frameworks.
 * The Facade Pattern hides the complexities of the system and provides a single interface through which the client can interact with the subsystem. 
 * This helps reduce dependencies and makes the system easier to use.
 */

class DVDPlayer {
    public function on(): void {
        echo "DVD Player is on.\n";
    }

    public function playMovie(string $movie): void {
        echo "Playing movie: $movie\n";
    }

    public function off(): void {
        echo "DVD Player is off.\n";
    }
}

class Projector {
    public function on(): void {
        echo "Projector is on.\n";
    }

    public function wideScreenMode(): void {
        echo "Projector in widescreen mode.\n";
    }

    public function off(): void {
        echo "Projector is off.\n";
    }
}

class SoundSystem {
    public function on(): void {
        echo "Sound System is on.\n";
    }

    public function setVolume(int $level): void {
        echo "Sound System volume set to $level.\n";
    }

    public function off(): void {
        echo "Sound System is off.\n";
    }
}

class Lights {
    public function dim(int $level): void {
        echo "Lights dimmed to $level%.\n";
    }

    public function on(): void {
        echo "Lights are on.\n";
    }
}

class HomeTheaterFacade {
    private $dvdPlayer;
    private $projector;
    private $soundSystem;
    private $lights;

    public function __construct(DVDPlayer $dvdPlayer, Projector $projector, SoundSystem $soundSystem, Lights $lights) {
        $this->dvdPlayer = $dvdPlayer;
        $this->projector = $projector;
        $this->soundSystem = $soundSystem;
        $this->lights = $lights;
    }

    public function watchMovie(string $movie): void {
        echo "Preparing to watch a movie...\n";
        $this->lights->dim(20);
        $this->soundSystem->on();
        $this->soundSystem->setVolume(10);
        $this->projector->on();
        $this->projector->wideScreenMode();
        $this->dvdPlayer->on();
        $this->dvdPlayer->playMovie($movie);
        echo "Enjoy your movie!\n";
    }

    public function endMovie(): void {
        echo "Shutting down the home theater...\n";
        $this->lights->on();
        $this->dvdPlayer->off();
        $this->projector->off();
        $this->soundSystem->off();
        echo "Goodbye!\n";
    }
}


// Subsystem components
$dvdPlayer = new DVDPlayer();
$projector = new Projector();
$soundSystem = new SoundSystem();
$lights = new Lights();

// Facade
$homeTheater = new HomeTheaterFacade($dvdPlayer, $projector, $soundSystem, $lights);

// Watch a movie
$homeTheater->watchMovie("Inception");

// End the movie
$homeTheater->endMovie();

