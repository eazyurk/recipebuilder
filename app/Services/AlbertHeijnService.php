<?php

namespace App\Services;

use App\Exceptions\CouldNotAuthenticateException;
use App\Services\AlbertHeijn\Resources\CategoryResource;
use App\Services\AlbertHeijn\Resources\ProductResource;
use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;
use Http;

class AlbertHeijnService
{
    use BuildBaseRequest, CanSendGetRequest;

    public function __construct(
        private readonly array  $headers,
        private readonly string $baseUrl,
        private array           $anonymousAccessToken = [],
    )
    {
        try {
            $this->anonymousAccessToken = $this->getAnonymousAccessToken();
        } catch (CouldNotAuthenticateException $exception) {
            die($exception);
        }
    }

    /**
     * @throws CouldNotAuthenticateException
     */
    public function getAnonymousAccessToken(): array
    {
        $response = Http::withHeaders($this->headers)
            ->post('https://api.ah.nl/mobile-auth/v1/auth/token/anonymous', [
                'clientId' => 'appie',
            ]);

        if (!$response->ok()) {
            throw new CouldNotAuthenticateException('Could not authenticate Albert Heijn API');
        }

        return $response->json();
    }

    public function products(): ProductResource
    {
        return new ProductResource($this);
    }

    public function categories(): CategoryResource
    {
        return new CategoryResource($this);
    }
}
