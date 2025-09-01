<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class UpdateOutOfStockProducts extends Command
{
    protected $signature = 'products:update-out-of-stock';
    protected $description = 'Update products with stock = 0 and status = available to out_of_stock';

    public function handle()
    {
        $products = Product::where('stock', 0)
            ->where('status', 'available')
            ->get();

        $count = $products->count();

        foreach ($products as $product) {
            $product->status = 'out_of_stock';
            $product->save();
        }

        $this->info("Updated {$count} product(s) to out_of_stock.");
    }
}
