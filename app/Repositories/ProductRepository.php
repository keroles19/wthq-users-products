<?php

namespace App\Repositories;

use App\Contract\ProductRepositoryInterface;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * Get all products
     *
     * @return array
     */
    public function getAllProducts(): array
    {
        $products = Product::get();
        return successResponse(200, ProductResource::collection($products));
    }

    /**
     * get product by id
     *
     * @param int $productId
     * @return array
     */
    public function getProductById(int $productId): array
    {
        $product = Product::findOrFail($productId);
        return successResponse(200, new ProductResource($product));

    }

    /**
     * Create product
     *
     * @param array $attributes
     * @return array
     */
    public function createProduct(array $attributes): array
    {
        $product = Product::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'price' => $attributes['price'],
            'is_active' => $attributes['is_active'] ? 1 : 0,
        ]);

        if (isset($attributes['image'])) {
            $image = upload($attributes['image'], 'products');
            $product->image = $image;
            $product->save();
        }

        return successResponse(201, new ProductResource($product));
    }

    /**
     * Update product
     *
     * @param array $attributes
     * @param int $productId
     * @return array
     */
    public function updateProduct(array $attributes, int $productId): array
    {
        $product = Product::findOrFail($productId);

        if (isset($attributes['image'])) {
            $attributes['image'] = upload($attributes['image'], 'products', $product->image ?? null);
        }

        $product->update(array_filter($attributes));


        return successResponse(200, new ProductResource($product));
    }

    /**
     * Delete product
     *
     * @param int $productId
     * @return array
     */
    public function deleteProduct(int $productId): array
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return successResponse(200, ['message' => __('Product deleted successfully')]);
    }


    /**
     * Return active products per user type
     *
     * @return array
     */
    public function getProductByUserType(): array
    {
        $products = Product::activeProduct()->productTypePrice(getAuthUserType())->get();
        return successResponse(200, ProductResource::collection($products));
    }
}