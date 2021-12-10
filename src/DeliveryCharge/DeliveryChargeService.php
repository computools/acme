<?php

namespace Acme\DeliveryCharge;

use Money\Money;

class DeliveryChargeService
{
    private Rules $rules;

    public function __construct(Rules $rules)
    {
        $this->rules = $rules;
    }

    public function addDeliveryCost(Money $amount): Money
    {
        return $this->applyRules($amount);
    }

    private function applyRules(Money $amount): Money
    {
        foreach ($this->rules->getRules() as $rule) {
            if ($amount->greaterThan($rule->getFrom())) {
                return $amount->add($rule->getCost());
            }
        }
    }
}
