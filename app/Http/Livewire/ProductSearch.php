<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class ProductSearch extends Component implements HasTable
{
    use InteractsWithTable;

    public function render(): string
    {
        return <<<'blade'
            <div>
                {{ $this->table }}
            </div>
        blade;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')->searchable(),
            Split::make([
                Stack::make([
                    TextColumn::make('perColumn')->getStateUsing(function (Product $record) {
                        return 'per ' . $record->nutrition->base_nutrient_value . $record->nutrition->base_nutrient_measurement_code;
                    }),
                    TextColumn::make('nutrition.kcal_value')
                        ->prefix('kcal ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->sortable()
                        ->size('sm'),
                    TextColumn::make('nutrition.fat_value')
                        ->prefix('vetten ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                    TextColumn::make('nutrition.carbohydrates_value')
                        ->prefix('koolhydraten ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                ]),
                Stack::make([
                    TextColumn::make('nutrition.sugars_value')
                        ->prefix('suikers ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                    TextColumn::make('nutrition.fiber_value')
                        ->prefix('vezels ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                    TextColumn::make('nutrition.protein_value')
                        ->prefix('eiwitten ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                    TextColumn::make('nutrition.salt_value')
                        ->prefix('zout ')
                        ->suffix(fn(Product $record) => $record->nutrition->base_nutrient_measurement_code)
                        ->size('sm'),
                ])
            ]),
        ];
    }

    protected function paginateTableQuery(Builder $query)
    {
        return $query->simplePaginate($this->getTableRecordsPerPage() == -1 ? $query->count() : $this->getTableRecordsPerPage());
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('Add product to recipe')
                ->action(fn(Product $record) => $this->emit('addProductToRecipe', $record))
                ->iconButton()
                ->icon('tabler-plus')
                ->color('success'),
        ];
    }

    protected function getTableQuery(): Builder|Relation
    {
        return Product::query()->with('nutrition');
    }
}
