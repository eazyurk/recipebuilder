<?php

namespace App\Services\AlbertHeijn\Resources;

use App\Services\AlbertHeijnService;
use Illuminate\Http\Client\Response;

class ProductResource
{
    public function __construct(private readonly AlbertHeijnService $service)
    {
    }

    public function searchProducts(string $query = '', int $page = 0, int $size = 750, string $sort = 'RELEVANCE'): Response
    {
        return $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: '/product/search/v2?sortOn=RELEVANCE',
            query: [
                'sortOn' => $sort,
                'page'   => $page,
                'size'   => $size,
                'query'  => $query,
            ]
        );
    }

    public function getProductDetails(int $productId): Response
    {
        return $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/product/detail/v4/fir/$productId",
        );
    }
}
