<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\OauthRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Resources\V1\ValidateResource;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function register(RegisterRequest $request, AuthService $service)
    {
        try {
            $payload = $request->all();
            $payload['ip'] = $request->ip() ?? null;
            $payload['user_agent'] = $request->userAgent() ?? null;
            $data = $service->register($payload);
            return response()->json(['data' => $data, 'message' => 'API request done']);
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

    public function login(LoginRequest $request, AuthService $service)
    {
        try {
            $payload = $request->all();
            $payload['ip'] = $request->ip() ?? null;
            $payload['user_agent'] = $request->userAgent() ?? null;
            $data = $service->login($payload);
            return response()->json([
                'data' => $data,
                'message' => 'API request done'
            ]);
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

    public function validate(Request $request)
    {
        return response()->json([
            'data' => new ValidateResource($request->user()),
            'message' => 'API request done'
        ]);
    }

    public function oauth(OauthRequest $request, AuthService $service)
    {
        try {
            $payload = $request->all();
            $payload['ip'] = $request->ip() ?? null;
            $payload['user_agent'] = $request->userAgent() ?? null;
            $data = $service->oauth($payload);
            return response()->json([
                'data' => $data,
                'message' => 'API request done'
            ]);
        } catch(Exception $e) {
            return response($e->getMessage());
        }
    }

}
