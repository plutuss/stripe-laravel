<?php

namespace Plutuss\Stripe\Faker;

use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;

interface FakerInterface
{

    public function generateValidatePaymentToken(): PaymentMethodInterface;

    public function setOptionalParameters(array $params): static;

}