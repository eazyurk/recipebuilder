<?php

namespace App\Services\AlbertHeijn\DTO;

class NutrientBasisQuantity
{
    public function __construct(
        public readonly float $value,
        public readonly MeasurementUnitCode $measurementUnitCode,
    )
    {
    }

    public static function fromArray(array $data): NutrientBasisQuantity
    {
        return new NutrientBasisQuantity(
            value: $data['value'],
            measurementUnitCode: MeasurementUnitCode::fromArray($data['measurementUnitCode']),
        );
    }
}
