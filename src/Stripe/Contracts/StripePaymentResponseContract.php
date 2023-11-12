<?php

namespace Plutuss\Stripe\Contracts;

interface StripePaymentResponseContract
{

    public function getAmount(): ?int;

}
