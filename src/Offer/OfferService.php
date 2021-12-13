<?php

namespace Acme\Offer;

use ErrorException;
use Illuminate\Support\Collection;

class OfferService
{
    private OfferRepository $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function applyOffers(Collection $products): Collection
    {
        $offers = $this->offerRepository->prepareOffersCollection();
        foreach ($offers as $offer) {
            $processor = $this->makeOfferProcessor($offer['type']);
            $processor->apply($products);
        }
        return $products;
    }

    /**
     * @param $type
     * @return OfferProcessorInterface
     * @throws ErrorException
     */
    private function makeOfferProcessor($type): OfferProcessorInterface
    {
        switch ($type) {
            case 'SpecialEverySecondProductHalfPrice':
                return new SpecialEverySecondProductHalfPriceProcessor();
            default: throw new ErrorException('Undefined offer ty[e');
        }
    }
}
