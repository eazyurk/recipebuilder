<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductNutrition extends Model
{
    protected $fillable = [
        'product_id',
        'base_nutrient_value',
        'base_nutrient_measurement_code',
        'kilojoule_value',
        'kcal_value',
        'fat_value',
        'saturated_fat_value',
        'unsaturated_fat_value',
        'mono_unsaturated_fat_value',
        'multiple_unsaturated_fat_value',
        'carbohydrates_value',
        'sugars_value',
        'fiber_value',
        'protein_value',
        'salt_value',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
