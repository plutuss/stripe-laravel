<?php

namespace Plutuss\Stripe\Confirm;



use Plutuss\Stripe\Contracts\StripeConfirmContract;
use Stripe\StripeClient;

class StripeConfirmService implements StripeConfirmContract
{

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createIntent(): ConfirmInterface
    {
        $setupIntent = $this->client->setupIntents->create([
            'payment_method_types' => ['card'],
        ]);

        return new Confirm([
            'id' => $setupIntent->id,
            'data' => $setupIntent,
        ]);
    }


    public function confirmIntent(string $intentId, $paymentMethod): ConfirmInterface
    {
        $setupIntent = $this->client->setupIntents->confirm(
            $intentId,
            ['payment_method' => $paymentMethod]
        );

        return new Confirm([
            'id' => $setupIntent->id,
            'data' => $setupIntent,
        ]);
    }

    public function attachMethodToCustomer($paymentMethod, $stripeCustomerId)
    {
        $this->client->paymentMethods->attach(
            $paymentMethod,
            [
                'customer' => $stripeCustomerId,
            ]
        );
    }


    public function setCustomerDefaultMethod($paymentMethod, $stripeCustomerId)
    {
        $this->client->customers->update(
            $stripeCustomerId,
            ['invoice_settings' => ['default_payment_method' => $paymentMethod]]
        );
    }

    public function getIntentFromSubscription($subscriptionId)
    {
        $sub = $this->client->subscriptions->retrieve($subscriptionId, []);
        $invoice = $this->client->invoices->retrieve($sub->latest_invoice, []);
        return $this->client->paymentIntents->retrieve($invoice->payment_intent, []);
    }
}
