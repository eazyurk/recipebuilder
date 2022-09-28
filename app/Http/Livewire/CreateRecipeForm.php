<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class CreateRecipeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public function render(): string
    {
        return <<<'blade'
            <div>
                {{ $this->form }}
            </div>
        blade;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('recipe_title')
                ->label('Recipe Title')
                ->required(),
        ];
    }
}
