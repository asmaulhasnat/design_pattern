<?php
/**
 * The Strategy Pattern is a behavioral design pattern that enables selecting an algorithm's behavior at runtime. Instead of implementing a single algorithm directly,
 * the code receives instructions on how to perform a specific behavior.
 * This is achieved by defining a family of algorithms (strategies), encapsulating each one in a separate class, and making them interchangeable within the context.
 */



interface PaymentStrategy {
    public function pay(float $amount): void;
}



class CreditCardPayment implements PaymentStrategy {
    private $cardNumber;

    public function __construct(string $cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function pay(float $amount): void {
        echo "Paying $" . $amount . " using Credit Card: " . $this->cardNumber . "\n";
    }
}



class PayPalPayment implements PaymentStrategy {
    private $email;

    public function __construct(string $email) {
        $this->email = $email;
    }

    public function pay(float $amount): void {
        echo "Paying $" . $amount . " using PayPal account: " . $this->email . "\n";
    }
}


class CryptoPayment implements PaymentStrategy {
    private $walletAddress;

    public function __construct(string $walletAddress) {
        $this->walletAddress = $walletAddress;
    }

    public function pay(float $amount): void {
        echo "Paying $" . $amount . " using Cryptocurrency wallet: " . $this->walletAddress . "\n";
    }
}




class Order {
    private $paymentStrategy;

    public function setPaymentStrategy(PaymentStrategy $strategy): void {
        $this->paymentStrategy = $strategy;
    }

    public function checkout(float $amount): void {
        if (!$this->paymentStrategy) {
            throw new Exception("Payment strategy is not set.");
        }
        $this->paymentStrategy->pay($amount);
    }
}



// Create an order
$order = new Order();

// Choose payment method and checkout
$order->setPaymentStrategy(new CreditCardPayment("1234-5678-9012-3456"));
$order->checkout(100.0); // Output: Paying $100 using Credit Card: 1234-5678-9012-3456

// Switch to PayPal payment
$order->setPaymentStrategy(new PayPalPayment("user@example.com"));
$order->checkout(200.0); // Output: Paying $200 using PayPal account: user@example.com

// Switch to Cryptocurrency payment
$order->setPaymentStrategy(new CryptoPayment("1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa"));
$order->checkout(300.0); // Output: Paying $300 using Cryptocurrency wallet: 1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa





