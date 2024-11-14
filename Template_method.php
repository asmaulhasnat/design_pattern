<?php
/**
 * The Template Method Pattern is a behavioral design pattern that defines the skeleton of an algorithm in a base class and allows subclasses to override specific steps of the algorithm without changing its structure.
 * It lets subclasses implement or extend certain steps of the algorithm, giving them flexibility while keeping the overall algorithm flow intact in the base class.
 */


abstract class DataProcessor {
    // Template method
    public function process(): void {
        $this->loadData();
        $this->parseData();
        $this->saveData();
    }

    // These methods can be overridden by subclasses
    abstract protected function loadData(): void;
    abstract protected function parseData(): void;
    
    // Concrete method with default implementation
    protected function saveData(): void {
        echo "Data has been saved.\n";
    }
}


class XMLDataProcessor extends DataProcessor {
    protected function loadData(): void {
        echo "Loading XML data...\n";
    }

    protected function parseData(): void {
        echo "Parsing XML data...\n";
    }
}



class JSONDataProcessor extends DataProcessor {
    protected function loadData(): void {
        echo "Loading JSON data...\n";
    }

    protected function parseData(): void {
        echo "Parsing JSON data...\n";
    }
}



// Process XML data
$xmlProcessor = new XMLDataProcessor();
$xmlProcessor->process();

echo "\n";

// Process JSON data
$jsonProcessor = new JSONDataProcessor();
$jsonProcessor->process();

