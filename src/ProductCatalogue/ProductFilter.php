<?php

namespace Acme\ProductCatalogue;

use Illuminate\Support\Collection;

class ProductFilter
{
    private Collection $codes;

    public static function make(): self
    {
        return new ProductFilter();
    }

    public function setCodes(Collection $codes): ProductFilter
    {
        $this->codes = $codes;

        return $this;
    }

    public function getCodes(): Collection
    {
        return $this->codes;
    }
}
