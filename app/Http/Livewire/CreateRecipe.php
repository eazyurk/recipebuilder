<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateRecipe extends Component
{
    protected $listeners = ['addProductToRecipe'];

    public Collection $products;
    public string $recipeTitle = '';

    public function mount(): void
    {
        $this->products = collect();
    }

    public function render(): View
    {
        return view('livewire.create-recipe')->layout('layouts.guest');
    }

    public function addProductToRecipe(Product $product)
    {
        $this->products->add([
            'product' => $product,
            'weight' => $product->nutrition->base_nutrient_value,
            'measurement_code' => $product->nutrition->base_nutrient_measurement_code,
        ]);
    }
}
