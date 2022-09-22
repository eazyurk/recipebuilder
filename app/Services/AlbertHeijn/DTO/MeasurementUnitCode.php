<?php

namespace App\Services\AlbertHeijn\DTO;

class MeasurementUnitCode
{
    public function __construct(
        public readonly string $value,
        public readonly string $label,
    )
    {
    }

    public static function fromArray(array $data): MeasurementUnitCode
    {
        return new MeasurementUnitCode(
            value: $data['value'],
            label: $data['label'],
        );
    }
}
