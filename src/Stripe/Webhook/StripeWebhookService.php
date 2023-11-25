<?php

namespace Plutuss\Stripe\Webhook;

use Plutuss\Stripe\Contracts\StripeWebhookContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeWebhookService implements StripeWebhookContract
{
    use HasOptionAttributeTrait;

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }


    /**
     * @param string|null $url
     * @param array $paramsWebhook
     * @return WebhookInterface
     * @throws ApiErrorException
     */
    public function createWebhook(string $url = null, array $paramsWebhook = []): WebhookInterface
    {
        if (empty($paramsWebhook)) {
            $paramsWebhook = [
                'enabled_events' => [
                    'charge.failed',
                    'charge.succeeded',
                ]
            ];
        }

        $params = array_merge($paramsWebhook, $this->params);

        $webhook = $this->client
            ->webhookEndpoints->create([
                'url' => $url ?? config('stripe-plutuss.stripe-webhook-secret'),
                $params
            ]);

        return new Webhook($webhook);
    }

    /**
     * @param string $webHookId
     * @return WebhookInterface
     * @throws ApiErrorException
     */
    public function retrieveWebhook(string $webHookId): WebhookInterface
    {
        $webhook = $this->client->webhookEndpoints->retrieve(
            $webHookId,
            $this->params
        );

        return new Webhook((array)$webhook);
    }

    /**
     * @param string $webHookId
     * @param string $url
     * @return WebhookInterface
     * @throws ApiErrorException
     */
    public function updateWebhook(string $webHookId, string $url): WebhookInterface
    {

        $enabled_events = ['url' => $url];

        $params = array_merge($enabled_events, $this->params);
        $webhook = $this->client->webhookEndpoints->update(
            $webHookId,
            $params
        );

        return new Webhook((array)$webhook);
    }

    /**
     * @param int $limit
     * @return WebhookInterface
     * @throws ApiErrorException
     */
    public function listAllWebhook(int $limit = 3): WebhookInterface
    {

        $enabled_events = ['limit' => $limit];

        $params = array_merge($enabled_events, $this->params);
        $webhook = $this->client->webhookEndpoints->all(
            $params
        );

        return new Webhook((array)$webhook);
    }

    /**
     * @param string $webHookId
     * @return WebhookInterface
     * @throws ApiErrorException
     */
    public function deleteWebhook(string $webHookId): WebhookInterface
    {
        $webhook = $this->client->webhookEndpoints->delete(
            $webHookId,
            $this->params
        );

        return new Webhook((array)$webhook);
    }
}
