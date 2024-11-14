<?php
interface Button {
    public function render();
}

interface Checkbox {
    public function render();
}





class WindowsButton implements Button {
    public function render() {
        echo "Rendering Windows-style Button\n";
    }
}

class MacButton implements Button {
    public function render() {
        echo "Rendering Mac-style Button\n";
    }
}

class WindowsCheckbox implements Checkbox {
    public function render() {
        echo "Rendering Windows-style Checkbox\n";
    }
}

class MacCheckbox implements Checkbox {
    public function render() {
        echo "Rendering Mac-style Checkbox\n";
    }
}


interface UIFactory {
    public function createButton(): Button;
    public function createCheckbox(): Checkbox;
}



class WindowsFactory implements UIFactory {
    public function createButton(): Button {
        return new WindowsButton();
    }

    public function createCheckbox(): Checkbox {
        return new WindowsCheckbox();
    }
}

class MacFactory implements UIFactory {
    public function createButton(): Button {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox {
        return new MacCheckbox();
    }
}



// Function that renders the UI, using a given factory to create elements.
function renderUI(UIFactory $factory) {
    $button = $factory->createButton();
    $checkbox = $factory->createCheckbox();

    $button->render();
    $checkbox->render();
}

// Client code decides the factory based on configuration or environment.
$os = "Windows"; // Could be dynamically set or detected.

if ($os === "Windows") {
    $factory = new WindowsFactory();
} else {
    $factory = new MacFactory();
}

renderUI($factory);


