<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected static $unguarded = true;

    public function nutrition(): HasOne
    {
        return $this->hasOne(ProductNutrition::class);
    }
}

