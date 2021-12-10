<?php

namespace Acme\DeliveryCharge;

use Acme\Basket;
use Illuminate\Support\Collection;
use Money\Currency;
use Money\Money;

class Rules
{
    public function getRules(): Collection
    {
        $rulesCollection = Collection::make();

        $rules = [
            [
                'from' => 9000,
                'cost' => 0,
            ],
            [
                'from' => 5000,
                'cost' => 295,
            ],
            [
                'from' => 0,
                'cost' => 495,
            ],
        ];

        foreach ($rules as $option) {
            $rule = new Rule();
            $rule->setFrom(new Money($option['from'], new Currency(Basket::CURRENCY)));
            $rule->setCost(new Money($option['cost'], new Currency(Basket::CURRENCY)));
            $rulesCollection->add($rule);
        }
        
        return $rulesCollection;
    }
}
