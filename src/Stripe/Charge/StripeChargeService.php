<?php

declare(strict_types=1);


namespace Plutuss\Stripe\Charge;


use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\StripeClient;

class StripeChargeService implements StripeChargeServiceInterface
{

    use HasOptionAttributeTrait;

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function chargesCreate(int $amount, string $source, string $currency = 'usd', string $description = ''): StripeChargeInterface
    {

        $params = array_merge([
            'amount' => $amount * 100,
            'currency' => $currency,
            'source' => $source,
            'description' => $description != '' ? $description : 'My First  Charge',
        ], $this->params);

        $charges = $this->client->charges->create($params);

        return new StripeCharge([
            'id' => $charges->id,
            'data' => $charges,
        ]);
    }

    public function chargesRetrieve(string $chId): StripeChargeInterface
    {
        $retrieve = $this->client->charges->retrieve(
            $chId,
            $this->params
        );

        return new StripeCharge([
            'id' => $retrieve->id,
            'data' => $retrieve,
        ]);
    }

    public function chargesUpdate(string $chId, array $metadata): StripeChargeInterface
    {
        $params = array_merge(['metadata' => $metadata], $this->params);

        $update = $this->client->charges->update($chId, $params);

        return new StripeCharge([
            'id' => $update->id,
            'data' => $update,
        ]);
    }

    public function chargesAll(int $limit = 3): StripeChargeInterface
    {

        $params = array_merge(['limit' => $limit], $this->params);

        $list = $this->client->charges->all($params);

        return new StripeCharge([
            'id' => $list->id,
            'data' => $list,
        ]);
    }
}
