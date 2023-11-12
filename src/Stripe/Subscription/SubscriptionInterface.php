<?php

namespace Plutuss\Stripe\Subscription;

interface SubscriptionInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
}
