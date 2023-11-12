<?php

namespace Plutuss\Stripe\Billing;

interface ChargeInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
    public function getAmount(): int;

}
