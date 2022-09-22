<?php

namespace App\Services\AlbertHeijn\DTO;

class NutritionalInformation
{
    public function __construct(
        public readonly NutrientBasisQuantity $nutrientBasisQuantity,
        public readonly array $nutrients = [],
    )
    {
    }

    public static function fromArray(array $data): NutritionalInformation
    {
        return new NutritionalInformation(
            nutrientBasisQuantity: NutrientBasisQuantity::fromArray(\Arr::first($data['nutrientHeaders'])['nutrientBasisQuantity'] ?? ['value' => 0, 'measurementUnitCode' => ['value' => 'g', 'label' => '']]),
            nutrients: array_map(fn(array $nutrient) => Nutrient::fromArray($nutrient), \Arr::first($data['nutrientHeaders'])['nutrientDetail'] ?? []),
        );
    }
}
