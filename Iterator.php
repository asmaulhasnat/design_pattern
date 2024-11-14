<?php
/**
 * The Iterator Pattern is a behavioral design pattern that provides a way to access elements of a collection sequentially without exposing its underlying structure.
 * This pattern decouples the algorithm for iterating from the collection itself,
 * providing a standard way to traverse collections.
 */

interface UserIterator {
    public function next(): ?User;
    public function hasNext(): bool;
}



interface UserCollection {
    public function createIterator(): UserIterator;
}



class User {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }
}



class UserList implements UserCollection {
    private $users = [];

    public function addUser(User $user): void {
        $this->users[] = $user;
    }

    public function createIterator(): UserIterator {
        return new UserListIterator($this->users);
    }
}



class UserListIterator implements UserIterator {
    private $users;
    private $position = 0;

    public function __construct(array $users) {
        $this->users = $users;
    }

    public function next(): ?User {
        return $this->hasNext() ? $this->users[$this->position++] : null;
    }

    public function hasNext(): bool {
        return $this->position < count($this->users);
    }
}



// Create user collection
$userList = new UserList();
$userList->addUser(new User("Alice"));
$userList->addUser(new User("Bob"));
$userList->addUser(new User("Charlie"));

// Get iterator
$iterator = $userList->createIterator();

// Traverse users
while ($iterator->hasNext()) {
    $user = $iterator->next();
    echo "User: " . $user->getName() . "\n";
}


