<?php

namespace Acme\ProductCatalogue;

use Illuminate\Support\Collection;
use Money\Money;

class Product
{
    private string $code;

    private Money $price;

    private string $name;

    private Collection $offers;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Product
    {
        $this->code = $code;

        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function setOffers(Collection $offers): Product
    {
        $this->offers = $offers;

        return $this;
    }
}
