<?php

namespace App\Http\Controllers\Api;

use App\Contract\AuthenticationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\CreateUserRequest;
use App\Http\Requests\Authentication\LoginUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function __construct(private readonly AuthenticationRepositoryInterface $authenticationRepository)
    {
    }

    /**
     * Register user
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function register(CreateUserRequest $request): JsonResponse
    {
        $result = $this->authenticationRepository->register($request->validated());
        return response()->json($result, $result['status_code']);
    }


    /**
     * @param LoginUserRequest $request
     * @return jsonResponse
     */
    public function login(LoginUserRequest $request): jsonResponse
    {
        $result = $this->authenticationRepository->login($request->validated());
        return response()->json($result, $result['status_code']);
    }

}
