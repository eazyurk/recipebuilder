<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class ShowRecipe extends Component
{
    public Recipe $recipe;

    public function mount(string $slug)
    {
        $this->recipe = Recipe::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.show-recipe')->layout('layouts.guest');
    }
}
