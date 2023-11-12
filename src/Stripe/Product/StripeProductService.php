<?php

namespace Plutuss\Stripe\Product;



use Plutuss\Stripe\Contracts\StripeProductContract;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeProductService implements StripeProductContract
{

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
        $product = $this->client
            ->products
            ->create([
                'name' => $plan->title,
            ]);

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
                    []
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

        $product = $this->client
            ->products
            ->update(
                $plan->stripe_product,
                [
                    'name' => $plan->title,
                    'active' => $active,
                ]
            );

        return new Product([
            'id' => $product->id,
            'data' => $product
        ]);
    }

}
