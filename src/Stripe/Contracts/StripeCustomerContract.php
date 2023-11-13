<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Customer\CustomerInterface;

interface StripeCustomerContract
{
    public function createCustomer(): CustomerInterface;

}