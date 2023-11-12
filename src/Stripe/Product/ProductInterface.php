<?php

namespace Plutuss\Stripe\Product;

interface ProductInterface
{
    public function getId(): string;

    public function getData(): \Illuminate\Support\Collection;
}
