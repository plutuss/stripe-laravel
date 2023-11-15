<?php

namespace Plutuss\Stripe\Price;


use Plutuss\Stripe\Contracts\StripePriceContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripePriceService implements StripePriceContract
{
    use HasOptionAttributeTrait;

    private StripeClient $client;
    /**
     * @var string
     */
    private string $interval = 'month';
    /**
     * @var array|string[]
     */
    private array $intervalArray = ['day', 'week', 'month', 'year'];

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createPrice($plan, $price = null): PriceInterface
    {
        $price = $this->getPrice($plan, $price);

        $params = array_merge([
            'unit_amount' => $price,
            'currency' => 'usd',
            'recurring' => [
                'interval' => $this->interval
            ],
            'product' => $plan->stripe_product,
        ],
            $this->params);

        $priceStripe = $this->client
            ->prices
            ->create($params);

        return new  Price([
            'id' => $priceStripe->id,
            'amount' => $priceStripe->unit_amount,
            'data' => $priceStripe,
        ]);
    }


    /**
     * @param $stripePriceId
     * @return PriceInterface
     * @throws ApiErrorException
     */
    public function deactivatePrice($stripePriceId): PriceInterface
    {
        $params = array_merge([
            'active' => false,
        ],
            $this->params);

        $priceStripe = $this->client
            ->prices
            ->update(
                $stripePriceId,
                $params

            );

        return new  Price([
            'id' => $priceStripe->id,
            'amount' => $priceStripe->unit_amount,
            'data' => $priceStripe,
        ]);
    }

    /**
     * @param $plan
     * @param $price
     * @return float|int
     */
    private function getPrice($plan, $price): float|int
    {
        if (!$price) {
            $price = $plan->price;
        }
        return $price * 100;

    }

    /**
     * @param string|null $interval
     * @return $this
     */
    public function setRecurringInterval(string $interval = null): static
    {
        if (!empty($interval && in_array($interval, $this->intervalArray))) {
            $this->interval = $interval;
        }
        return $this;
    }

}
