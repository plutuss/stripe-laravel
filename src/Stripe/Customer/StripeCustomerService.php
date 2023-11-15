<?php

namespace Plutuss\Stripe\Customer;

use App\Models\User;

use Plutuss\Stripe\Contracts\StripeCustomerContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeCustomerService implements StripeCustomerContract
{

    use HasOptionAttributeTrait;

    protected ?User $user;
    private StripeClient $client;

    public function __construct(StripeClient $client)
    {
        $this->user = auth()->user();
        $this->client = $client;
    }


    /**
     * @return CustomerInterface
     * @throws ApiErrorException
     */
    public function createCustomer(): CustomerInterface
    {
        $params = array_merge([
            'email' => $this->user->email,
            'name' => $this->user->name,
            'description' => config('app.name') . ' customer',
        ],
            $this->params);

        if (!empty($this->user->stripe_customer_id)) {
            $stripeCustomer = $this->checkStripeCustomer();
        } else {
            $stripeCustomer = $this->client
                ->customers
                ->create($params);

        }

        $this->user->update([
            'stripe_customer_id' => $stripeCustomer->id ?? null,
        ]);

        return new Customer([
            'id' => $stripeCustomer->id,
            'data' => $stripeCustomer
        ]);
    }

    /**
     * @return Customer|null
     * @throws ApiErrorException
     */
    private function checkStripeCustomer(): ?\Stripe\Customer
    {
        try {
            $customerExist = $this->client
                ->customers
                ->retrieve($this->user->stripe_customer_id, []);

            if ($customerExist && $customerExist->deleted) {
                return null;
            }
            return $customerExist;
        } catch (\Stripe\Exception\InvalidRequestException$e) {
            return null;
        }
    }


}
