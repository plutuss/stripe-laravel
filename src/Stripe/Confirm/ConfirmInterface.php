<?php

namespace Plutuss\Stripe\Confirm;

interface ConfirmInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
}
