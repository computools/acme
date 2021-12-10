<?php

namespace Acme\Offer;

use Acme\Basket;
use Illuminate\Support\Collection;
use Money\Currency;
use Money\Money;

class OfferService
{
    public function applyOffers(Collection $products): Collection
    {
        $counterOfProductCodes = 0;
        $code = 'R01';

        foreach ($products as $productItem) {
            if ($productItem->getCode() == $code) {
                $counterOfProductCodes++;
                if ($counterOfProductCodes % 2 == 0) {
                    $productItem->setPrice((new Money($productItem->getPrice()->getAmount(), new Currency(Basket::CURRENCY)))->divide(2, PHP_ROUND_HALF_DOWN));
                }
            }
        }

        return $products;
    }
}
