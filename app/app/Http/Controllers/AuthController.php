<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() 
    {
        
    }

    public function login(Request $request) : JsonResponse
    {
        return response()->json([]);
    }

    public function logout(Request $request) : JsonResponse
    {
        return response()->json([]);
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
