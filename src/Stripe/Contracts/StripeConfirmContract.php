<?php

namespace Plutuss\Stripe\Contracts;

interface StripeConfirmContract
{
    public function createIntent();

    public function confirmIntent(string $intentId, string $paymentMethod);

    public function attachMethodToCustomer(string $paymentMethod, string  $stripeCustomerId);

    public function setCustomerDefaultMethod( string $paymentMethod, string $stripeCustomerId);

    public function getIntentFromSubscription( string $subscriptionId);

    public function setOptionalParameters(array $params): static;
}
