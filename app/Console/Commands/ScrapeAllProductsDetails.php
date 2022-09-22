<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductNutrition;
use App\Services\AlbertHeijnService;
use Illuminate\Console\Command;

class ScrapeAllProductsDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:all-products-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape all products details';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AlbertHeijnService $service): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            $detailsArray = $service->products()->getProductDetails($product->webshop_id)->json();

            if (!isset($detailsArray['tradeItem']['nutritionalInformation'])) {
                Product::where('webshop_id', $product->webshop_id)->delete();
                continue;
            }

            $productDetails = \App\Services\AlbertHeijn\DTO\Product::fromArray($detailsArray);
            $product = Product::where('webshop_id', $productDetails->webshopId)->firstOrFail();

            $this->info("Adding nutrition for product: {$product->title}");

            $productNutrition = ProductNutrition::firstOrCreate(['product_id' => $product->id]);

            $productNutrition->update([
                'base_nutrient_value'            => $productDetails->nutritionalInformation->nutrientBasisQuantity->value,
                'base_nutrient_measurement_code' => $productDetails->nutritionalInformation->nutrientBasisQuantity->measurementUnitCode->value,
            ]);


            foreach ($productDetails->nutritionalInformation->nutrients as $nutrient) {
                if ($nutrient->nutrientTypeCode->value === 'ENER-') {
                    if ($nutrient->measurementUnitCode->value === 'kJ') {
                        $productNutrition->kilojoule_value = $nutrient->value;
                    } else {
                        $productNutrition->kcal_value = $nutrient->value;
                    }
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'FAT') {
                    $productNutrition->fat_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'FASAT') {
                    $productNutrition->saturated_fat_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'X_FUNS') {
                    $productNutrition->unsaturated_fat_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'FAMSCIS') {
                    $productNutrition->mono_unsaturated_fat_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'FAPUCIS') {
                    $productNutrition->multiple_unsaturated_fat_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'CHOAVL') {
                    $productNutrition->carbohydrates_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'SUGAR-') {
                    $productNutrition->sugars_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'FIBTG') {
                    $productNutrition->fiber_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'PRO-') {
                    $productNutrition->protein_value = $nutrient->value;
                    continue;
                }

                if ($nutrient->nutrientTypeCode->value === 'SALTEQ') {
                    $productNutrition->salt_value = $nutrient->value;
                    continue;
                }
            }

            $productNutrition->save();
        }
    }
}
