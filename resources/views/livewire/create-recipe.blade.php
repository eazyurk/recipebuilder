<div class="min-h-screen flex">
    <div class="w-80 pr-4">
        <livewire:product-search/>
    </div>
    <div class="py-6">
        <h1>Recept</h1>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($products as $key => $product)
                <li class="flex py-4">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $product['product']['title'] }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Per {{ $product['weight'] }} {{ $product['product']['nutrition']['base_nutrient_measurement_code'] }}
                            {{ $product['product']['nutrition']['kcal_value'] / $product['product']['nutrition']['base_nutrient_value'] * $product['weight']}}
                            kcal
                        </p>
                    </div>
                    <div class="ml-3">
                        <div>
                            <input type="email" name="email" id="email"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   wire:model="products.{{ $key }}.weight"
                                   placeholder="Gewicht ({{ $product['product']['nutrition']['base_nutrient_measurement_code'] }})"/>

                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
