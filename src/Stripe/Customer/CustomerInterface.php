<?php

namespace Plutuss\Stripe\Customer;

interface CustomerInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
}
