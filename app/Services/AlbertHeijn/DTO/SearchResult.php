<?php

namespace App\Services\AlbertHeijn\DTO;

class SearchResult
{
    /**
     * @param Page $page
     * @param SearchProduct[] $products
     */
    public function __construct(
        public readonly Page          $page,
        public readonly array $products = [],
    )
    {
    }

    public static function fromArray(array $data): SearchResult
    {
        return new SearchResult(
            page: Page::fromArray($data['page']),
            products: array_map(fn(array $subLocation) => SearchProduct::fromArray($subLocation), $data['products'] ?? []),
        );
    }
}
