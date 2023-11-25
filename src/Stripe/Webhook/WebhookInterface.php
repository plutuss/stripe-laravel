<?php

namespace Plutuss\Stripe\Webhook;

use Illuminate\Support\Collection;

interface WebhookInterface
{
    public function getId(): string;

    public function getData(): Collection;
}
