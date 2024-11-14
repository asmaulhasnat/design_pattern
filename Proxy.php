<?php
/**
 * The Proxy Pattern is a structural design pattern that provides a placeholder or surrogate for another object to control access to it.
 * It acts as an intermediary, managing the creation and interaction with an actual object, allowing the proxy to add functionality (such as access control, lazy initialization, logging, or caching) without changing the original object’s interface.
 */

interface Image {
    public function display(): void;
}


class RealImage implements Image {
    private $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadImage();
    }

    private function loadImage(): void {
        echo "Loading image from file: {$this->filename}\n";
    }

    public function display(): void {
        echo "Displaying image: {$this->filename}\n";
    }
}


class ImageProxy implements Image {
    private $filename;
    private $realImage;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function display(): void {
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename); // Lazy initialization
        }
        $this->realImage->display();
    }
}



// Client code
$image1 = new ImageProxy("photo1.jpg");
$image2 = new ImageProxy("photo2.jpg");

// No loading yet
echo "Image proxies created.\n";

// Image loads only when display is called
$image1->display(); // Loading and displaying photo1.jpg
$image1->display(); // Only displaying photo1.jpg (already loaded)

$image2->display(); // Loading and displaying photo2.jpg
