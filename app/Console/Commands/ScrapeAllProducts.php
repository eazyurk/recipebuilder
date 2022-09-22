<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\AlbertHeijn\DTO\SearchResult;
use App\Services\AlbertHeijnService;
use Illuminate\Console\Command;

class ScrapeAllProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:all-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape all products';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AlbertHeijnService $service, $pageCount = 0): void
    {
        foreach ($service->categories()->getCategories()->json() as $category) {
            foreach (explode(',', $category['name']) as $t) {
                $search = trim($t, ' ');

                $this->scrape($search, $pageCount, $service);
            }
        }
    }

    public function scrape(string $category, $pageCount, $service)
    {
        $count = 0;
        $this->info("Search string $category");
        $products = $service->products()
            ->searchProducts(query: $category, page: $pageCount)
            ->json();
        if (!isset($products['page'])) {
            return;
        }
        $result = SearchResult::fromArray($products);

        $totalPages = $result->page->totalPages;

        foreach ($result->products as $product) {
            $count++;
            Product::updateOrCreate(['webshop_id' => $product->webshopId], ['title' => $product->title]);
        }

        $this->info("Logged $count products");
        $currentPage = $result->page->number;
        if ($currentPage < ($totalPages - 1)) {
            $this->info("Switching from $currentPage to $pageCount+1");
            $this->scrape($category, $pageCount+1, $service);
        }
    }
}
