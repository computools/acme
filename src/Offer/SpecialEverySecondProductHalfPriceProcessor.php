<?php

namespace Acme\Offer;

use Acme\Basket;
use Illuminate\Support\Collection;
use Money\Currency;

use Money\Money;

class SpecialEverySecondProductHalfPriceProcessor implements OfferProcessorInterface
{
    const TYPE = 'SpecialEverySecondProductHalfPrice';

    public function apply(Collection $products): Collection
    {
        $counterOfProducts = 0;

        foreach ($products as $product) {
            $offers = $product->getOffers();
            foreach ($offers as $offer) {
                if (self::TYPE == $offer['type']) {
                    $counterOfProducts++;
                    if ($counterOfProducts % 2 == 0) {
                        $product->setPrice((new Money($product->getPrice()->getAmount(), new Currency(Basket::CURRENCY)))->divide(2, PHP_ROUND_HALF_DOWN));
                    }
                }
            }
        }

        return $products;
    }
}
