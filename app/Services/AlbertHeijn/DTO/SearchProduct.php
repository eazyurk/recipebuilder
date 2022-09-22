<?php

namespace App\Services\AlbertHeijn\DTO;

class SearchProduct
{
    public function __construct(
        public readonly int    $webshopId,
        public readonly string $title,
    )
    {
    }

    public static function fromArray(array $data): SearchProduct
    {
        return new SearchProduct(
            webshopId: $data['webshopId'],
            title: $data['title'],
        );
    }
}
