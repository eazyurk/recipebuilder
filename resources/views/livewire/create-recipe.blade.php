<div class="min-h-screen grid grid-cols-3 gap-4">
    <div class="pr-4">
        <livewire:product-search/>
    </div>
    <div class="flex flex-col">
        <div>
            <input type="text"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   wire:model="recipeTitle"
                   placeholder="Recept titel"/>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($products as $key => $product)
                <li class="flex py-4" wire:key="{{ $key }}">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $product['product']['title'] }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Per {{ $product['weight'] }} {{ $product['measurement_code'] }}
                        <div class="grid grid-cols-2 gap-x-2">
                            <div class="text-sm text-gray-500">
                                kcal {{ $product['product']['nutrition']['kcal_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}
                            </div>
                            <div class="text-sm text-gray-500">
                                vetten {{ $product['product']['nutrition']['fat_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                koolhydraten {{ $product['product']['nutrition']['carbohydrates_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                suikers {{ $product['product']['nutrition']['sugars_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                vezels {{ $product['product']['nutrition']['fiber_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                eiwitten {{ $product['product']['nutrition']['protein_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                zout {{ $product['product']['nutrition']['salt_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}{{ $product['measurement_code'] }}
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="ml-3">
                        <div>
                            <input type="number"
                                   min="1"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   wire:model="products.{{ $key }}.weight"
                                   placeholder="Gewicht ({{ $product['measurement_code'] }})"/>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @if ($products->isNotEmpty())
        <div>
            Voedingswaarden van dit recept
            (voor {{ $products->sum('weight') }} {{ $products->first()['measurement_code'] }})

            <table class="min-w-full divide-y divide-gray-300">
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        kcal
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['kcal_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        vetten
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['fat_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        koolhydraten
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['carbohydrates_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        suikers
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['sugars_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        vezels
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['fiber_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        eiwitten
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['protein_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        zout
                    </td>
                    <td class="py-4 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-6 md:pr-0">
                        {{ $products->sum(function($product) {
                            return $product['product']['nutrition']['salt_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight'];
                        }) }}
                    </td>
                </tr>
            </table>
            <button
                wire:click="saveRecipe"
                class="mt-3 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Recept opslaan
            </button>
        </div>
    @endif
</div>
