<?php

namespace App\Services;

use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

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

    public function login($payload)
    {
        if(!Auth::attempt([
            'username' => $payload['user'],
            'password' => $payload['password']
        ]))
        throw new Exception('Invalid credentials');

        $user = User::findOrFail(Auth::id());
        $accessToken = $user->createToken('user');

        return [
            'accessToken' => $accessToken->plainTextToken,
            'user' => new UserResource($user)
        ];
    }

}