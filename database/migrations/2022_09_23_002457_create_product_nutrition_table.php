<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_nutrition', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class);
            $table->float('base_nutrient_value')->default(0);
            $table->string('base_nutrient_measurement_code')->default('g');
            $table->float('kilojoule_value')->default(0);
            $table->float('kcal_value')->default(0);
            $table->float('fat_value')->default(0);
            $table->float('saturated_fat_value')->default(0);
            $table->float('unsaturated_fat_value')->default(0);
            $table->float('mono_unsaturated_fat_value')->default(0);
            $table->float('multiple_unsaturated_fat_value')->default(0);
            $table->float('carbohydrates_value')->default(0);
            $table->float('sugars_value')->default(0);
            $table->float('fiber_value')->default(0);
            $table->float('protein_value')->default(0);
            $table->float('salt_value')->default(0);


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_nutrition');
    }
};
