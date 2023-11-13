<?php

namespace Plutuss\Stripe\Subscription;

use Illuminate\Support\Collection;

interface SubscriptionInterface
{
    public function getId(): string;

    public function getData(): Collection;
}
