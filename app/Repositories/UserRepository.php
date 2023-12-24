<?php

namespace App\Repositories;

use App\Contract\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Get all Users
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        $users = User::notAdmin()->get();
        return successResponse(200, UserResource::collection($users));
    }

    /**
     * get product by id
     *
     * @param int $userId
     * @return array
     */
    public function getUserById(int $userId): array
    {
        $user = User::notAdmin()->findOrFail($userId);
        return successResponse(200, new UserResource($user));

    }

    /**
     * Create product
     *
     * @param array $attributes
     * @return array
     */
    public function createUser(array $attributes): array
    {
        $user = User::create([
            'name' => $attributes['name'],
            'user_name' => $attributes['user_name'],
            'password' => bcrypt($attributes['password']),
            'type' => $attributes['type'],
            'is_active' => $attributes['is_active'] ? 1 : 0,
        ]);

        if (array_key_exists('avatar', $attributes)) {
            $user->avatar = upload($attributes['avatar'], 'users');
            $user->save();
        }

        return successResponse(201, ['message' => __('User created successfully')]);
    }

    /**
     * Update product
     *
     * @param array $attributes
     * @param int $userId
     * @return array
     */
    public function updateUser(array $attributes, int $userId): array
    {
        $user = User::notAdmin()->findOrFail($userId);

        if (isset($attributes['avatar'])) {
            $attributes['avatar'] = upload($attributes['avatar'], 'users', $user->image ?? null);
        }


        $user->update(array_filter($attributes));


        return successResponse(200, ['message' => __('User updated successfully')]);
    }

    /**
     * Delete product
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser(int $userId): array
    {
        $user = User::notAdmin()->findOrFail($userId);
        $user->delete();
        return successResponse(200, ['message' => __('User deleted successfully')]);
    }

}