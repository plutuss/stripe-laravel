<?php

namespace Plutuss\Stripe\Traits;


trait HasOptionAttributeTrait
{
    private array $params = [];


    /**
     * @param array $params
     * @return $this
     */
    public function setOptionalParameters(array $params): static
    {
        $this->params = $params;

        return $this;
    }


}
