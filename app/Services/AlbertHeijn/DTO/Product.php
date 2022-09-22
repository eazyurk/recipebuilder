<?php

namespace App\Services\AlbertHeijn\DTO;

class Product
{
    public function __construct(
        public readonly int $webshopId,
        public readonly string $brand,
        public readonly NutritionalInformation $nutritionalInformation,
    )
    {
    }

    public static function fromArray(array $data): Product
    {
        return new Product(
            webshopId: $data['productCard']['webshopId'],
            brand: $data['productCard']['brand'],
            nutritionalInformation: NutritionalInformation::fromArray($data['tradeItem']['nutritionalInformation']),
        );
    }
}
