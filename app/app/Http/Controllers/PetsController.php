<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IPetsServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    protected IPetsServices $pets;

    public function __construct(IPetsServices $pets) 
    {
        $this->pets = $pets;
    }

    public function getAll() : JsonResponse
    {
        return response()->json();
    }

    public function getById() : JsonResponse
    {
        return response()->json([]);
    }

    public function getNotifys() : JsonResponse
    {
        return response()->json([]);
    }

    public function getByForeignKey() : JsonResponse
    {
        return response()->json([]);
    }

    public function store(Request $request) : JsonResponse
    {
        $data = $request->only(['name', 'weight', 'size', 'age', 'desc_pets', 'status']);
        return response()->json($this->pets->store($data));
    }
}
