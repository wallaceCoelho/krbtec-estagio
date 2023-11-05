<?php

namespace App\Http\Controllers;

use App\Mail\MailPasswordService;
use App\Models\User;
use App\Services\Interfaces\IAuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected IAuthServices $auth;

    public function __construct(IAuthServices $auth) 
    {
        $this->auth = $auth;
    }
    
    public function me() : JsonResponse
    {
        return $this->auth->me();
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

    public function refresh() : JsonResponse
    {
        return response()->json($this->auth->refresh());
    }

    public function verifyEmail() : JsonResponse
    {
        return response()->json([]);
    }

    public function resetPassword(Request $request) : JsonResponse
    {
        $userExist = User::where('email', $request['email'])->get();
        if($userExist)
        {
            $token = Str::random(60);
            Mail::to($request['email'])->send(new MailPasswordService($token));
            return response()->json(['response' => 'Email enviado', 'token' => $token]);
        }
        return response()->json(['response' => 'Email não cadastrado!']);
    }
}
