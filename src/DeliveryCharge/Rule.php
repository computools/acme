<?php

namespace Acme\DeliveryCharge;

use Money\Money;

class Rule
{
    private Money $from;

    private Money $cost;

    public function getFrom(): Money
    {
        return $this->from;
    }

    public function setFrom(Money $from): Rule
    {
        $this->from = $from;

        return $this;
    }

    public function getCost(): Money
    {
        return $this->cost;
    }

    public function setCost(Money $cost): Rule
    {
        $this->cost = $cost;

        return $this;
    }
}
