<?php
/**
 * The Memento Pattern is a behavioral design pattern used to save and restore an object's state.
 * This is useful when you need to provide undo/redo functionality or keep snapshots of an object's state without exposing its internal details. 
 * The Memento Pattern keeps the saved state secure by separating the state-saving logic from the main object logic.
 */

class EditorMemento {
    private $content;

    public function __construct(string $content) {
        $this->content = $content;
    }

    public function getContent(): string {
        return $this->content;
    }
}



class TextEditor {
    private $content = "";

    public function type(string $words): void {
        $this->content .= " " . $words;
    }

    public function save(): EditorMemento {
        return new EditorMemento($this->content);
    }

    public function restore(EditorMemento $memento): void {
        $this->content = $memento->getContent();
    }

    public function getContent(): string {
        return $this->content;
    }
}

class History {
    private $mementos = [];

    public function saveState(EditorMemento $memento): void {
        $this->mementos[] = $memento;
    }

    public function undo(): ?EditorMemento {
        return !empty($this->mementos) ? array_pop($this->mementos) : null;
    }
}




// Create editor and history
$editor = new TextEditor();
$history = new History();

// Type and save state
$editor->type("Hello");
$history->saveState($editor->save());

$editor->type("world!");
$history->saveState($editor->save());

$editor->type("This is a text editor.");
echo "Current Content: " . $editor->getContent() . "\n"; // Output: Current Content: Hello world! This is a text editor.

// Undo last action
$lastState = $history->undo();
if ($lastState !== null) {
    $editor->restore($lastState);
}
echo "After Undo: " . $editor->getContent() . "\n"; // Output: After Undo: Hello world!

// Another undo
$lastState = $history->undo();
if ($lastState !== null) {
    $editor->restore($lastState);
}
echo "After Another Undo: " . $editor->getContent() . "\n"; // Output: After Another Undo: Hello


