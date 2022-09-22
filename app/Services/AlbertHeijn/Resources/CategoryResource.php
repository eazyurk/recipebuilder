<?php

namespace App\Services\AlbertHeijn\Resources;

use App\Services\AlbertHeijnService;
use Illuminate\Http\Client\Response;

class CategoryResource
{
    public function __construct(public readonly AlbertHeijnService $service)
    {
    }

    public function getCategories(): Response
    {
        return $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: '/v1/product-shelves/categories'
        );
    }

    public function getSubCategories(int $categoryId): Response
    {
        return $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/v1/product-shelves/categories/$categoryId/sub-categories",
        );
    }
}
