<?php

namespace Acme\Offer;

use Illuminate\Support\Collection;

class OfferRepository
{
    public function prepareOffersCollection(): Collection
    {
        return collect([
            [
                'id' => 1,
                'type' => 'SpecialEverySecondProductHalfPrice',
            ]
        ]);
    }
}