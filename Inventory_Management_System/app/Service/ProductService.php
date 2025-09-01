<?php

namespace App\Service; 
use App\Models\Product;

class ProductService 
{

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }


    /**
     * Delete a product.
     *
     * @param Product $product
     * @return bool|null
     */
    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return Product::all();
    }
    
    public function getProductsById($id)
    {
        return Product::find($id);
    }
    public function updateProduct(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }
}