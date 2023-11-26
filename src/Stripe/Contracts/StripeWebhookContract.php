<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Webhook\WebhookInterface;
use Stripe\Collection;

interface StripeWebhookContract
{


    /**
     * @param string|null $url
     * @param array $paramsWebhook
     * @return WebhookInterface
     */
    public function createWebhook(string $url = null, array $paramsWebhook = []): WebhookInterface;

    /**
     * @param string $webHookId
     * @return WebhookInterface
     */
    public function retrieveWebhook(string $webHookId): WebhookInterface;

    /**
     * @param string $webHookId
     * @param string $url
     * @return WebhookInterface
     */
    public function updateWebhook(string $webHookId, string $url): WebhookInterface;


    /**
     * @param int $limit
     * @return Collection
     */
    public function listAllWebhook(int $limit = 3): \Stripe\Collection;

    /**
     * @param string $webHookId
     * @return WebhookInterface
     */
    public function deleteWebhook(string $webHookId): WebhookInterface;

    /**
     * @param array $params
     * @return $this
     */
    public function setOptionalParameters(array $params): static;
}
