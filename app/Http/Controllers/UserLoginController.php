<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserLoginController extends Controller
{
    public function __construct()
    {
        auth()->shouldUse('api_user');
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            if (!$token = auth()->claims(['type' => 'admin'])->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'errors' => [
                        'email' => ['These credentials do not match our records.'],
                    ]
                ], 422);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token!'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user'       => auth()->user(),
            'user_type'  => 'admin'
        ], 200);
    }
}
