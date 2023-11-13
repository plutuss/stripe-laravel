<?php

namespace Plutuss\Stripe\Contracts;

interface StripeProductContract
{

    public function createProduct($plan);

    public function deleteProduct($plan);

    public function updateProduct($plan, $active = true);
}
