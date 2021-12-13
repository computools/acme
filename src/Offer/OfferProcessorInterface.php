<?php

namespace Acme\Offer;

use Illuminate\Support\Collection;

interface OfferProcessorInterface
{
    public function apply(Collection $products): Collection;
}
