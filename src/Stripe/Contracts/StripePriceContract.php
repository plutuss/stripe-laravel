<?php

namespace Plutuss\Stripe\Contracts;

interface StripePriceContract
{

    public function createPrice($plan, $price);

    public function deactivatePrice($stripePriceId);

    public function setRecurringInterval(string $interval = null): static;

}
