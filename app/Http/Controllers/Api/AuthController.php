<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    public function test()
    {
        return response()->json(['message' => 'Test successful']);
    }

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
    public function register(LoginRequest $request)
    {
        // هنا يمكنك إضافة منطق التسجيل إذا كنت تريد
        $user = \App\Models\User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            'access_token' => $token,
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user'         => $user,
        ]);
        return response()->json(['message' => 'Registration not implemented'], 501);
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
