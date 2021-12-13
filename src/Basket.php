<?php

namespace Acme;

use Acme\DeliveryCharge\DeliveryChargeService;
use Acme\Offer\OfferService;
use Acme\ProductCatalogue\ProductCatalogue;
use Acme\ProductCatalogue\ProductFilter;
use Illuminate\Support\Collection;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\AggregateMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class Basket
{
    public const CURRENCY = 'USD';

    private ProductCatalogue $productCatalogue;

    private DeliveryChargeService $deliveryChargeService;

    private Collection $productCodes;

    private OfferService $offerService;

    public function __construct(
        ProductCatalogue $productCatalogue,
        DeliveryChargeService $deliveryChargeService,
        OfferService $offerService
    )
    {
        $this->productCatalogue = $productCatalogue;
        $this->deliveryChargeService = $deliveryChargeService;
        $this->offerService = $offerService;
        $this->productCodes = new Collection();
    }

    public function add(string $productCode): Basket
    {
        $this->productCodes->add($productCode);

        return $this;
    }

    public function getTotal(): string
    {
        $productFilter = ProductFilter::make();

        $codes = $productFilter->setCodes($this->productCodes);

        $products = $this->productCatalogue->getAll($codes);
        $productsWithAppliedOffer = $this->offerService->applyOffers($products);

        $totalPrice = $this->getTotalPrice($productsWithAppliedOffer);
        $deliveryPricedProducts = $this->deliveryChargeService->addDeliveryCost($totalPrice);

        return $this->moneyFormatter($deliveryPricedProducts);
    }

    private function getTotalPrice(Collection $products): Money
    {
        $total = $products->sum(function ($product) {
            return $product->getPrice()->getAmount();
        });

        return new Money($total, new Currency(Basket::CURRENCY));
    }

    public function moneyFormatter(Money $prices): string
    {
        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $intlFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        $moneyFormatter = new AggregateMoneyFormatter([
            'USD' => $intlFormatter,
        ]);

        return $moneyFormatter->format($prices);
    }
}
