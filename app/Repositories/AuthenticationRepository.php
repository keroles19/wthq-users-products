<?php

namespace App\Repositories;

use App\Contract\AuthenticationRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{

    // Make Register Function
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
        ]);

        if ($user->save()) {
            $token = $user->createToken($user->user_name)->plainTextToken;

            if (array_key_exists('avatar', $data)) {
                $user->avatar = upload($data['avatar'], 'users');
                $user->save();
            }

            $result = new UserResource($user);
            $result['token'] = $token;

            return successResponse(201, $result);
        } else {
            return failedResponse(400, ['error' => 'Bad Request']);
        }
    }


    /**
     * Login Function
     *
     * @param array $data
     * @return array|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
     */
    public function login(array $data): Application|Response|array|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        if (!auth()->attempt($data)) {
            return failedResponse(404, ['error' => 'These credentials do not match our records.']);
        }

        $user = User::where('user_name', $data['user_name'])->first();
        $token = $user->createToken($user->user_name)->plainTextToken;

        $result = new UserResource($user);
        $result['token'] = $token;

        return successResponse(200, $result);
    }


}