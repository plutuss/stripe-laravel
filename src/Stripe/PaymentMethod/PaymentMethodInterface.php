<?php

namespace Plutuss\Stripe\PaymentMethod;

use Illuminate\Support\Collection;

interface PaymentMethodInterface
{

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return Collection
     */
    public function getData(): Collection;

}
