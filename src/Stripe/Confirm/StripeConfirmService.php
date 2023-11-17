<?php

namespace Plutuss\Stripe\Confirm;


use Plutuss\Stripe\Contracts\StripeConfirmContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\StripeClient;

class StripeConfirmService implements StripeConfirmContract
{

    use HasOptionAttributeTrait;

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createIntent(): ConfirmInterface
    {
        $params = array_merge([
            'payment_method_types' => ['card'],
        ], $this->params);

        $setupIntent = $this->client->setupIntents->create($params);

        return new Confirm([
            'id' => $setupIntent->id,
            'data' => $setupIntent,
        ]);
    }


    public function confirmIntent(string $intentId, $paymentMethod): ConfirmInterface
    {
        $params = array_merge(['payment_method' => $paymentMethod], $this->params);

        $setupIntent = $this->client->setupIntents->confirm(
            $intentId,
            $params
        );

        return new Confirm([
            'id' => $setupIntent->id,
            'data' => $setupIntent,
        ]);
    }

    public function attachMethodToCustomer($paymentMethod, $stripeCustomerId)
    {
        $params = array_merge([
            'customer' => $stripeCustomerId,
        ], $this->params);

        $this->client->paymentMethods->attach(
            $paymentMethod,
            $params
        );
    }


    public function setCustomerDefaultMethod($paymentMethod, $stripeCustomerId)
    {
        $params = array_merge([
            'invoice_settings' => ['default_payment_method' => $paymentMethod]
        ],
            $this->params);
        $this->client->customers->update(
            $stripeCustomerId,
            $params
        );
    }

    public function getIntentFromSubscription($subscriptionId)
    {
        $sub = $this->client->subscriptions->retrieve($subscriptionId, []);
        $invoice = $this->client->invoices->retrieve($sub->latest_invoice, []);
        return $this->client->paymentIntents->retrieve($invoice->payment_intent, []);
    }
}
