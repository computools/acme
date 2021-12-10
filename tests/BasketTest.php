<?php

namespace Tests;

use Acme\Basket;
use Acme\DeliveryCharge\DeliveryChargeService;
use Acme\DeliveryCharge\Rules;
use Acme\Offer\OfferService;
use Acme\ProductCatalogue\ProductCatalogue;
use Acme\ProductCatalogue\ProductRepository;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    /**
     * @dataProvider getTotalDataProvider
     * @param array $input
     * @param array $expected
     */
    public function testGetTotal(array $input, array $expected)
    {

        $rules = new Rules();
        $product = new ProductRepository();

        $basket = new Basket(
            new ProductCatalogue($product),
            new DeliveryChargeService($rules),
            new OfferService()
        );


        foreach ($input['codes'] as $code) {
            $basket->add($code);
        }

        $this->assertEquals($expected['total'], $basket->getTotal());
    }

    public function getTotalDataProvider(): array
    {
        return [
            'B01, G01' => [
                [
                    'codes' => [
                        'B01',
                        'G01',
                    ]
                ],
                [
                    'total' => '$37.85',
                ]
            ],
            'R01, R01' => [
                [
                    'codes' => [
                        'R01',
                        'R01',
                    ]
                ],
                [
                    'total' => '$54.37',
                ]
            ],
            'R01, G01' => [
                [
                    'codes' => [
                        'R01',
                        'G01',
                    ]
                ],
                [
                    'total' => '$60.85',
                ]
            ],
            'B01, B01, R01, R01, R01' => [
                [
                    'codes' => [
                        'B01',
                        'B01',
                        'R01',
                        'R01',
                        'R01',
                    ]
                ],
                [
                    'total' => '$98.27',
                ]
            ],
        ];
    }

}