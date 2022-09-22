<?php

namespace App\Services\AlbertHeijn\DTO;

class Page
{
    public function __construct(
        public readonly int $size,
        public readonly int $totalElements,
        public readonly int $totalPages,
        public readonly int $number,
    )
    {
    }

    public static function fromArray(array $data): Page
    {
        return new Page(
            size: $data['size'],
            totalElements: $data['totalElements'],
            totalPages: $data['totalPages'],
            number: $data['number'],
        );
    }
}
