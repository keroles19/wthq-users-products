<?php

namespace App\Http\Controllers\Api;

use App\Contract\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\CreateUserRequest;
use App\Http\Requests\Products\ProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * Get all products
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = $this->productRepository->getAllProducts();
        return response()->json($result, $result['status_code']);
    }

    /**
     * Get product by id
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function show(int $productId): JsonResponse
    {
        $result = $this->productRepository->getProductById($productId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Create product
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $result = $this->productRepository->createProduct($request->validated());
        return response()->json($result, $result['status_code']);
    }

    /**
     * Delete product
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function destroy(int $productId): JsonResponse
    {
        $result = $this->productRepository->deleteProduct($productId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Update product
     *
     * @param ProductRequest $request
     * @param int $productId
     * @return JsonResponse
     */
    public function update(ProductRequest $request, int $productId): JsonResponse
    {
        $result = $this->productRepository->updateProduct($request->validated(), $productId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * show active product by user type
     *
     * @return JsonResponse
     */
    public function getProductByUserType(): JsonResponse
    {
        $result = $this->productRepository->getProductByUserType();
        return response()->json($result, $result['status_code']);
    }

}
