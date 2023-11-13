<?php

namespace Plutuss\Stripe\Contracts;
interface StripeSubscriptionContract
{
    public function createSubscription(string $priceId, $trial_end_at = false);

    public function checkSubscription(string $subscriptionId);

    public function canceledSubscription(string $subscriptionId);
}
