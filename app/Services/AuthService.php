<?php

namespace App\Services;

use App\Http\Resources\V1\UserResource;

class AuthService
{
    
    public function register($payload)
    {
        $userService = app()->make(UserService::class);
        $user = $userService->create($payload);

        $accessToken = $user->createToken('user');
        
        return [
            'accessToken' => $accessToken->plainTextToken,
            'user' => new UserResource($user)
        ];
    }

}