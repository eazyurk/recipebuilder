<?php

namespace App\Services\Concerns;

use Http;
use Illuminate\Http\Client\PendingRequest;

trait BuildBaseRequest
{
    public function buildRequestWithToken(): PendingRequest
    {
        return $this->withBaseUrl()->withToken($this->anonymousAccessToken['access_token']);
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl(
            url: $this->baseUrl,
        )->withHeaders($this->headers);
    }
}
