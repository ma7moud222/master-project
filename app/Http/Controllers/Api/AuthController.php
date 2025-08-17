<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // محاولة تسجيل الدخول
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // رجع التوكن + بيانات اليوزر
        return response()->json([
            'access_token' => $token,
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user'         => auth('api')->user(),
        ]);
    }

    public function refresh()
    {
        $token = JWTAuth::parseToken()->refresh();
        return response()->json([
            'access_token' => $token,
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout(true);
        return response()->json(['message' => 'Successfully logged out']);
    }
}
