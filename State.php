<?php
/**
 * The State Pattern is a behavioral design pattern that allows an object to change its behavior when its internal state changes.
 *  This pattern is particularly useful when an object has multiple states, and each state requires a different response to the same method calls.
 *  It enables an object to alter its behavior dynamically based on its state, without using conditional statements to handle state transitions.
 */



interface DocumentState {
    public function edit(Document $document): void;
    public function publish(Document $document): void;
    public function reject(Document $document): void;
}




class Document {
    private $state;

    public function __construct(DocumentState $state) {
        $this->setState($state);
    }

    public function setState(DocumentState $state): void {
        $this->state = $state;
    }

    public function edit(): void {
        $this->state->edit($this);
    }

    public function publish(): void {
        $this->state->publish($this);
    }

    public function reject(): void {
        $this->state->reject($this);
    }
}




class DraftState implements DocumentState {
    public function edit(Document $document): void {
        echo "Document is being edited in Draft mode.\n";
    }

    public function publish(Document $document): void {
        echo "Document submitted for review.\n";
        $document->setState(new ReviewState());
    }

    public function reject(Document $document): void {
        echo "Document is already in Draft. Cannot reject.\n";
    }
}



class ReviewState implements DocumentState {
    public function edit(Document $document): void {
        echo "Cannot edit document while under review.\n";
    }

    public function publish(Document $document): void {
        echo "Document is published.\n";
        $document->setState(new PublishedState());
    }

    public function reject(Document $document): void {
        echo "Document rejected. Returning to Draft.\n";
        $document->setState(new DraftState());
    }
}



class PublishedState implements DocumentState {
    public function edit(Document $document): void {
        echo "Cannot edit document after it is published.\n";
    }

    public function publish(Document $document): void {
        echo "Document is already published.\n";
    }

    public function reject(Document $document): void {
        echo "Cannot reject document after it is published.\n";
    }
}


// Start with a document in draft state
$document = new Document(new DraftState());

// Edit document in draft state
$document->edit(); // Output: Document is being edited in Draft mode.

// Publish document (move to review state)
$document->publish(); // Output: Document submitted for review.

// Try to edit document in review state
$document->edit(); // Output: Cannot edit document while under review.

// Publish document again (move to published state)
$document->publish(); // Output: Document is published.

// Attempt to edit after publishing
$document->edit(); // Output: Cannot edit document after it is published.



