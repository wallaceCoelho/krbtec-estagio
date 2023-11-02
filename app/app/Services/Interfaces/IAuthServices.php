<?php

namespace App\Services\Interfaces;

use Illuminate\Http\JsonResponse;

interface IAuthServices
{
    public function login(array $credentials) : JsonResponse;

    public function me() : JsonResponse;

    public function logout() : JsonResponse;

    public function refresh() : JsonResponse;
}