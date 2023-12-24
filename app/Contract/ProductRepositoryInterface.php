<?php


namespace App\Contract;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function getProductById(int $productId);

    public function createProduct(array $attributes);

    public function updateProduct(array $attributes, int $productId);

    public function deleteProduct(int $productId);

}
