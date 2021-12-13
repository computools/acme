<?php

namespace Acme\ProductCatalogue;

use Illuminate\Support\Collection;

class ProductOfferRepository
{
    public function prepareRelationCollection(): Collection
    {
        return collect([
            [
                'product_code' => 'R01',
                'offer_id' => 1,
            ]
        ]);
    }
}
