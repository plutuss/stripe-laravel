<?php

namespace Plutuss\Stripe\Charge;

interface StripeChargeInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
}
