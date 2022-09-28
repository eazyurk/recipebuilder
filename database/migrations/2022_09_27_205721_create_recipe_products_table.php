<?php

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('recipe_products', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Recipe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->float('weight')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_products');
    }
};
