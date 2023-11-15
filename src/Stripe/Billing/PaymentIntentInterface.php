<?php

namespace  Plutuss\Stripe\Billing;

use Illuminate\Support\Collection;

interface PaymentIntentInterface
{
    public function getId(): string;

    public function getData(): Collection;

    public function getAmount(): ?int;
}
