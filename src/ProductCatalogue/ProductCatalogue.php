<?php

namespace Acme\ProductCatalogue;

use Illuminate\Support\Collection;

class ProductCatalogue
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(ProductFilter $filter): Collection
    {
        return $this->productRepository->getAll($filter);
    }
}
