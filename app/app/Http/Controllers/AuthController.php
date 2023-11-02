<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IAuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected IAuthServices $auth;

    public function __construct(IAuthServices $auth) 
    {
        $this->auth = $auth;
    }
    
    public function login(Request $request) : JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        return $this->auth->login($credentials);
    }

    public function logout() : JsonResponse
    {
        return response()->json($this->auth->logout());
    }

    public function refreshToken() : JsonResponse
    {
        return response()->json([]);
    }

    public function verifyEmail() : JsonResponse
    {
        return response()->json([]);
    }

    public function resetPassword() : JsonResponse
    {
        return response()->json([]);
    }
}
