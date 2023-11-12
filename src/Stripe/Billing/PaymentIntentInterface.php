<?php

namespace  Plutuss\Stripe\Billing;

interface PaymentIntentInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;

    public function getAmount(): ?int;
}
