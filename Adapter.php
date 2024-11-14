<?php

interface PaymentGateway {
    public function pay(float $amount): void;
}



#represent gateway
class PayPal {
    public function sendPayment(float $amount): void {
        echo "Paying $" . $amount . " using PayPal.\n";
    }
}
#represent gateway
class Stripe {
    public function makePayment(float $amount): void {
        echo "Paying $" . $amount . " using Stripe.\n";
    }
}


class PayPalAdapter implements PaymentGateway {
    private $payPal;

    public function __construct(PayPal $payPal) {
        $this->payPal = $payPal;
    }

    public function pay(float $amount): void {
        // Adapting PayPal’s `sendPayment` method to the `pay` method in PaymentGateway
        $this->payPal->sendPayment($amount);
    }
}


class StripeAdapter implements PaymentGateway {
    private $stripe;

    public function __construct(Stripe $stripe) {
        $this->stripe = $stripe;
    }

    public function pay(float $amount): void {
        // Adapting Stripe’s `makePayment` method to the `pay` method in PaymentGateway
        $this->stripe->makePayment($amount);
    }
}



class PaymentProcessor {
    private $gateway;

    public function __construct(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function processPayment(float $amount): void {
        $this->gateway->pay($amount);
    }
}


// Using PayPal
$payPal = new PayPal();
$payPalAdapter = new PayPalAdapter($payPal);
$paymentProcessor = new PaymentProcessor($payPalAdapter);
$paymentProcessor->processPayment(100.00);  // Output: Paying $100 using PayPal.

// Using Stripe
$stripe = new Stripe();
$stripeAdapter = new StripeAdapter($stripe);
$paymentProcessor = new PaymentProcessor($stripeAdapter);
$paymentProcessor->processPayment(200.00);  // Output: Paying $200 using Stripe.