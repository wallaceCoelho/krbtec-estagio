<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IUserServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected IUserServices $user;

    public function __construct(IUserServices $user) 
    {
        $this->user = $user;
    }

    public function getAll() : JsonResponse
    {
        return response()->json([$this->user->getAll()]);
    }

    public function getUser(Request $request) : JsonResponse
    {
        $id = (int) $request->get('id');
        return response()->json($this->user->getUser($id));
    }

    public function store(Request $request) : JsonResponse
    {
        $data = $request->only(['name', 'email', 'status', 'password']);
        return response()->json($this->user->store($data));
    }

    public function delete(Request $request) : JsonResponse
    {
        $id = (int) $request->only(['id']);
        return response()->json($this->user->delete($id));
    }

    public function update(Request $request) : JsonResponse
    {
        $data = $request->only(['id', 'name', 'email', 'status', 'password']);
        return response()->json($this->user->update($data));
    }
}
