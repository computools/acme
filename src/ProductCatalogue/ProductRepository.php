<?php

namespace Acme\ProductCatalogue;

use Acme\Basket;
use Illuminate\Support\Collection;
use Money\Currency;
use Money\Money;

class ProductRepository
{
    /**
     * @param ProductFilter $filters
     * @return Collection
     */
    public function getAll(ProductFilter $filters): Collection
    {
        $productsCollection = new Collection();

        foreach ($filters->getInfo() as $code) {

            $filteredProduct = $this->prepareProductCollection()->where('code', '=', $code)->first();

            $product = new Product();
            $product->setName($filteredProduct['productName']);
            $product->setCode($filteredProduct['code']);
            $product->setPrice(new Money(($filteredProduct['productPrice']), new Currency(Basket::CURRENCY)));

            $productsCollection->add($product);
        }

        return $productsCollection;
    }

    /**
     * @return Collection
     */
    private function prepareProductCollection(): Collection
    {
        return collect([
            [
                'productName' => 'Red Widget',
                'code' => 'R01',
                'productPrice' => 3295
            ],
            [
                'productName' => 'Green Widget',
                'code' => 'G01',
                'productPrice' => 2495
            ],
            [
                'productName' => 'Blue Widget',
                'code' => 'B01',
                'productPrice' => 795
            ]

        ]);
    }
}
