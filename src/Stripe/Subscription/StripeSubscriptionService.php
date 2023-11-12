<?php

namespace Plutuss\Stripe\Subscription;

use App\Models\User;
use Plutuss\Stripe\Contracts\StripeSubscriptionContract;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeSubscriptionService implements StripeSubscriptionContract
{

    protected ?User $user;
    private StripeClient $client;

    public function __construct($client)
    {
        $this->user = auth()->user();
        $this->client = $client;

    }

    /**
     * @param string $priceId
     * @param $trial_end_at
     * @return Subscription
     * @throws ApiErrorException
     */
    public function createSubscription(string $priceId, $trial_end_at = null): Subscription
    {
        $subscriptionData = [];

        $subscriptionData[] = [
            'customer' => $this->user->stripe_customer_id,
            'items' => [
                [
                    'price' => $priceId
                ]
            ]
        ];

        if (!empty($trial_end_at)) {
            $subscriptionData['trial_end'] = $trial_end_at;
        }

        $response = $this->client->subscriptions->create($subscriptionData);

        return new Subscription([
            'id' => $response->id,
            'data' => $response,
        ]);

    }

    /**
     * @param string $subscriptionId
     * @return Subscription
     * @throws ApiErrorException
     */
    public function checkSubscription(string $subscriptionId): Subscription
    {
        $subscription = $this->client->subscriptions->retrieve($subscriptionId, []);
        $price = 0;
        foreach ($subscription->items as $item) {
            $price += ($item->plan->amount);
        }

        $subscriptionInfo = $this->subscriptionInfo($subscription, $price);

        return new Subscription([
            'id' => $subscription->id,
            'data' => $subscriptionInfo,
        ]);
    }

    /**
     * @param string $subscriptionId
     * @return Subscription
     * @throws ApiErrorException
     */
    public function canceledSubscription(string $subscriptionId): Subscription
    {
        $response = $this->client->subscriptions->cancel(
            $subscriptionId,
            []
        );

        return new Subscription([
            'id' => $response->id,
            'data' => $response,
        ]);
    }

    /**
     * @param $subscription
     * @param $price
     * @return Collection
     */

    private function subscriptionInfo($subscription, $price): Collection
    {
        $status = $subscription->status == 'canceled' ? true : false;

        $subscriptionInfo = collect([
            'id' => $subscription->id,
            'is_active' => false,
            'status' => $subscription->status,
            'end_at' => \Carbon\Carbon::createFromTimestamp($subscription->current_period_end),
            'canceled' => $status,
            'price' => $price / 100,
        ]);

        if ($subscription->status == 'active') {
            $subscriptionInfo->is_active = true;
        } else {

            $subscriptionInfo->is_active = (int)$subscriptionInfo->end_at > now();
        }

        return $subscriptionInfo;
    }
}
