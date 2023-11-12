<?php

namespace Plutuss\Stripe\Contracts;

interface StripeResponseContract
{

    public function getId(): string;


    public function getData(): \Illuminate\Support\Collection;

}
