<?php
/*
    The Factory pattern is a creational design pattern that provides an interface for creating objects in a superclass but allows subclasses to alter the type of objects that will be created. 
    It’s useful when a class cannot anticipate the type of objects it needs to create, or when it wants its subclasses to specify those details.

    Factory Pattern Structure
    In the Factory pattern:

    Factory Class: Defines a method (usually called create) that returns an object.
    Product Interface: Specifies the interface that all products must implement.
    Concrete Products: Classes implementing the product interface and providing specific implementations.
    Example in PHP
    Imagine a scenario where we have a Notification system that can send notifications via different channels like Email, 
    SMS, or Push notifications. The Factory pattern allows us to create specific notification objects without modifying the client code.
 */

interface Notification {
    public function send(string $message);
}

class EmailNotification implements Notification {
    public function send(string $message) {
        echo "Sending Email: " . $message . "\n";
    }
}

class SMSNotification implements Notification {
    public function send(string $message) {
        echo "Sending SMS: " . $message . "\n";
    }
}

class PushNotification implements Notification {
    public function send(string $message) {
        echo "Sending Push Notification: " . $message . "\n";
    }
}

class NotificationFactory {
    public function createNotification(string $type): ?Notification {
        switch ($type) {
            case 'email':
                return new EmailNotification();
            case 'sms':
                return new SMSNotification();
            case 'push':
                return new PushNotification();
            default:
                return null;
        }
    }
}



$factory = new NotificationFactory();

// Request an email notification
$emailNotification = $factory->createNotification('email');
$emailNotification?->send("Hello via Email!");

// Request an SMS notification
$smsNotification = $factory->createNotification('sms');
$smsNotification?->send("Hello via SMS!");

// Request a push notification
$pushNotification = $factory->createNotification('push');
$pushNotification?->send("Hello via Push Notification!");