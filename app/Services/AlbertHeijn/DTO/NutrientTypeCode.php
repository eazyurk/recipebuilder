<?php

namespace App\Services\AlbertHeijn\DTO;

class NutrientTypeCode
{
    public function __construct(
        public readonly string $value,
        public readonly string $label,
    )
    {
    }

    public static function fromArray(array $data): NutrientTypeCode
    {
        return new NutrientTypeCode(
            value: $data['value'],
            label: $data['label'],
        );
    }
}
