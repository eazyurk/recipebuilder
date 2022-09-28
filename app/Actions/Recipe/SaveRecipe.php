<?php

namespace App\Actions\Recipe;

use App\Models\Recipe;
use Illuminate\Support\Collection;

class SaveRecipe
{
    public function __invoke(Collection $products, string $recipeTitle): Recipe
    {
        return $this->execute($products, $recipeTitle);
    }

    public function execute(Collection $products, string $recipeTitle): Recipe
    {
        $recipe = new Recipe();
        $recipe->title = $recipeTitle;
        $recipe->user()->associate(\Auth::user());
        $recipe->save();

        $products->each(function ($product) use ($recipe) {
            $recipe->products()->attach($product['product']['id'], [
                'weight' => $product['weight'],
            ]);
        });

        return $recipe;
    }
}
