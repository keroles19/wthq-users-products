<?php

namespace App\Http\Controllers\Api;

use App\Contract\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Requests\Users\UserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Get all products
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = $this->userRepository->getAllUsers();
        return response()->json($result, $result['status_code']);
    }

    /**
     * Get product by id
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show(int $userId): JsonResponse
    {
        $result = $this->userRepository->getUserById($userId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Create product
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $result = $this->userRepository->createUser($request->validated());
        return response()->json($result, $result['status_code']);
    }

    /**
     * Delete product
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy(int $userId): JsonResponse
    {
        $result = $this->userRepository->deleteUser($userId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Update product
     *
     * @param UserRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $userId): JsonResponse
    {
        $result = $this->userRepository->updateUser($request->validated(), $userId);
        return response()->json($result, $result['status_code']);
    }

}
