<?php

namespace Plutuss\Stripe\Contracts;

use Plutuss\Stripe\Webhook\WebhookInterface;

interface StripeWebhookContract
{

    /**
     * @return WebhookInterface
     */
    public function createWebhook(): WebhookInterface;

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
     * @return WebhookInterface
     */
    public function listAllWebhook(int $limit = 3): WebhookInterface;

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
