<?php

namespace App\Services;

use App\Enums\AuthProviderCase;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

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

    public function oauth($payload)
    {
        $provider = $payload['provider'];
        if($provider == AuthProviderCase::Github->value)
            $userGithub = $this->getGithubUser($payload['code']);
        else throw new Exception("Provider $provider is not supported");

        $userService = app()->make(UserService::class);
        $user = $userService->createOrUpdateGithubProfile($userGithub);

        $token = $user->createToken('user');

        return [
            'accessToken' => $token->plainTextToken,
            'user' => new UserResource($user)
        ];
    }

    private function getGithubUser($code)
    {
        try {
            $response = Http::post('https://github.com/login/oauth/access_token', [
                'client_id' => config('services.github.client_id'),
                'client_secret' => config('services.github.client_secret'),
                'code' => $code,
                'accept' => 'application/json'
            ]);
            $token = explode('=', explode('&', $response)[0])[1];
            $user = Socialite::driver(AuthProviderCase::Github->value)->stateless()->userFromToken($token);
            return $user;
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

}