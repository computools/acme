<?php

namespace Acme\ProductCatalogue;

use Acme\Basket;
use Acme\Offer\OfferRepository;
use Illuminate\Support\Collection;
use Money\Currency;
use Money\Money;

class ProductRepository
{
    private ProductOfferRepository $productOfferRepository;
    private OfferRepository $offerRepository;

    public function __construct(ProductOfferRepository $productOfferRepository, OfferRepository $offerRepository)
    {
        $this->productOfferRepository = $productOfferRepository;
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param ProductFilter $filters
     * @return Collection
     */
    public function getAll(ProductFilter $filters): Collection
    {
        $productsCollection = new Collection();

        foreach ($filters->getCodes() as $code) {

            $filteredProduct = $this->prepareProductCollection()->where('code', '=', $code)->first();

            $productOffers = $this->productOfferRepository->prepareRelationCollection()->where('product_code', '=', $code);

            $offers = collect();
            foreach($productOffers as $productOffer) {
                $offers->add($this->offerRepository->prepareOffersCollection()->where('id', '=', $productOffer['offer_id'])->first());
            }

            $product = new Product();
            $product->setName($filteredProduct['productName']);
            $product->setCode($filteredProduct['code']);
            $product->setPrice(new Money(($filteredProduct['productPrice']), new Currency(Basket::CURRENCY)));
            $product->setOffers($offers);

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
