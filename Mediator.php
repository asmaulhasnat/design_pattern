<?php

interface ChatMediator {
    public function sendMessage(string $message, User $user): void;
    public function addUser(User $user): void;
}



class ChatRoom implements ChatMediator {
    private $users = [];

    public function addUser(User $user): void {
        $this->users[] = $user;
    }

    public function sendMessage(string $message, User $user): void {
        foreach ($this->users as $u) {
            if ($u !== $user) {  // Avoid sending the message to the sender
                $u->receive($message);
            }
        }
    }
}




abstract class User {
    protected $mediator;
    protected $name;

    public function __construct(ChatMediator $mediator, string $name) {
        $this->mediator = $mediator;
        $this->name = $name;
    }

    public function send(string $message): void {
        echo $this->name . " sends: " . $message . "\n";
        $this->mediator->sendMessage($message, $this);
    }

    public function receive(string $message): void {
        echo $this->name . " received: " . $message . "\n";
    }
}



class BasicUser extends User {
    // No additional behavior for now, but can be extended if needed
}

$chatRoom = new ChatRoom();

// Create users
$user1 = new BasicUser($chatRoom, "Alice");
$user2 = new BasicUser($chatRoom, "Bob");
$user3 = new BasicUser($chatRoom, "Charlie");

// Register users with the chat room
$chatRoom->addUser($user1);
$chatRoom->addUser($user2);
$chatRoom->addUser($user3);

// Send messages
$user1->send("Hello, everyone!");
$user2->send("Hi, Alice!");



