<?php

namespace Plutuss\Stripe\Price;

interface PriceInterface
{
    public function getId(): string;
     public function getData(): \Illuminate\Support\Collection;
}
