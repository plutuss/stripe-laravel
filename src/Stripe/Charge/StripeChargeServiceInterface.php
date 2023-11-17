<?php

namespace Plutuss\Stripe\Charge;

interface StripeChargeServiceInterface
{

    /**
     * @param int $amount
     * @param string $source
     * @param string $currency
     * @param string $description
     * @return StripeChargeInterface
     */
    public function chargesCreate(int $amount, string $source, string $currency = 'usd', string $description = ''): StripeChargeInterface;

    /**
     * @param string $chId
     * @return StripeChargeInterface
     */
    public function chargesRetrieve(string $chId): StripeChargeInterface;

    /**
     * @param string $chId
     * @param array $metadata
     * @return StripeChargeInterface
     */
    public function chargesUpdate(string $chId, array $metadata): StripeChargeInterface;

    /**
     * @param int $limit
     * @return StripeChargeInterface
     */
    public function chargesAll(int $limit = 3): StripeChargeInterface;

    /**
     * @param array $params
     * @return $this
     */
    public function setOptionalParameters(array $params): static;

}
