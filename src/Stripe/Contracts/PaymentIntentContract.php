<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Billing\PaymentIntentInterface;

interface PaymentIntentContract
{
    public function createPayment(int $amount, string $token, string $currency = 'usd'): PaymentIntentInterface;

    public function setOptionalParameters(array $params): static;

}
