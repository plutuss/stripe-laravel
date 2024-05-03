<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Customer\CustomerInterface;

interface StripeCustomerContract
{
    /**
     * @param string|null $email
     * @param string|null $name
     * @param string|null $description
     * @return CustomerInterface
     */
    public function createCustomer(string $email = null, string $name = null, string $description = null): CustomerInterface;


    /**
     * @param array $params
     * @return $this
     */
    public function setOptionalParameters(array $params): static;
}
