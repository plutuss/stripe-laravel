<?php

namespace Plutuss\Stripe\Product;


use Plutuss\Stripe\Contracts\StripeProductContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeProductService implements StripeProductContract
{

    use HasOptionAttributeTrait;

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param $plan
     * @return ProductInterface
     * @throws ApiErrorException
     */
    public function createProduct($plan): ProductInterface
    {

        $params = array_merge([
            'name' => $plan->title,
        ],
            $this->params);
        $product = $this->client
            ->products
            ->create($params);

        return new Product([
            'id' => $product->id,
            'data' => $product
        ]);
    }

    /**
     * @param $plan
     * @return ProductInterface|string
     * @throws ApiErrorException
     */
    public function deleteProduct($plan): ProductInterface|string
    {
        try {
            $response = $this->client
                ->products
                ->delete(
                    $plan->stripe_product,
                    $this->params
                );
        } catch (\Stripe\Exception\InvalidRequestException $exception) {
            return $exception->getMessage();
        }

        return new Product([
            'id' => $response->id,
            'data' => $response
        ]);
    }


    public function updateProduct($plan, $active = true): ProductInterface
    {

        $params = array_merge([
            'name' => $plan->title,
            'active' => $active,
        ],
            $this->params);

        $product = $this->client
            ->products
            ->update(
                $plan->stripe_product,
                $params
            );

        return new Product([
            'id' => $product->id,
            'data' => $product
        ]);
    }

}
