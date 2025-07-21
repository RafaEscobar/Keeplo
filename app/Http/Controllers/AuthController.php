<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Resources\RegisterResource;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());
            $token = $user->createToken('auth_token')->plainTextToken;
            return new RegisterResource($user, $token);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function logout()
    {

    }
}
