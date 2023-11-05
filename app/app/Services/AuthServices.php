<?php

namespace App\Services;

use App\Services\Interfaces\IAuthServices;
use DateTime;
use DateTimeZone;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthServices implements IAuthServices
{
    public function __construct()
    {}

    public function login(array $credentials) : JsonResponse
    {
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['Erro' => 'Não autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me() : JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout() : JsonResponse
    {
        try
        {
            if (auth()->check()) 
            {    
                auth()->logout();
                return response()->json(['message' => 'Sessão finalizada com sucesso'], 200);
            }
            return response()->json(['message' => 'Nenhuma sessãoa tiva', 401]);
        }
        catch(JWTException $e)
        {
            return response()->json(['message' => 'Erro: '.$e], 500);
        }
    }

    public function refresh() : JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken(string $token) : JsonResponse
    {
        $userId = auth()->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user_id' => $userId['id'],
            'expires_in' => auth()->factory()->getTTL(),
            'login_in' => new DateTime('now', new DateTimeZone('America/Sao_Paulo'))
        ]);
    }
}