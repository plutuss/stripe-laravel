<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Billing\PaymentIntentInterface;

interface PaymentIntentContract
{
    public function createPayment(int $amount, string $token): PaymentIntentInterface;

}
