<?php

namespace Acme\ProductCatalogue;

class ProductFilter
{
    private array $info;

    public static function make(): self
    {
        return new ProductFilter();
    }

    public function setInfo($options): ProductFilter
    {
        $this->info = $options->toArray();

        return $this;
    }

    public function getInfo()
    {
        return $this->info;
    }
}
