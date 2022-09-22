<?php

namespace App\Services\AlbertHeijn\DTO;

class Nutrient
{
    public function __construct(
        public readonly float $value,
        public readonly MeasurementUnitCode $measurementUnitCode,
        public readonly NutrientTypeCode $nutrientTypeCode,
    )
    {
    }

    public static function fromArray(array $data): Nutrient
    {
        return new Nutrient(
            value: \Arr::first($data['quantityContained'])['value'],
            measurementUnitCode: MeasurementUnitCode::fromArray(\Arr::first($data['quantityContained'])['measurementUnitCode']),
            nutrientTypeCode: NutrientTypeCode::fromArray($data['nutrientTypeCode']),
        );
    }
}
