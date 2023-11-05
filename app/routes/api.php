<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(NotifyController::class)->group(function () 
{
    Route::post('/sendNotify', 'store');
});

Route::controller(UserController::class)->group(function () 
{
    Route::middleware(['jwt.auth'])->group(function () 
    {
        Route::post('/register', 'store');
        Route::post('/delete', 'delete');
        Route::post('/update', 'update');
        Route::get('/getUsers', 'getAll');
        Route::get('/getUser', 'getUser');
    });
});

Route::controller(PetsController::class)->group(function () 
{
    Route::middleware(['jwt.auth'])->group(function () 
    {
        Route::post('/registerPet', 'store');
        Route::post('/updatePet', 'update');
        Route::post('/deletePets', 'delete');
    });
    Route::get('/getPets', 'getAll');
    Route::get('/getPet', 'getPet');
});

Route::controller(AuthController::class)->group(function () 
{
    Route::middleware(['jwt.auth'])->group(function () 
    {
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::get('/me', 'me');
    });
    Route::post('/login', 'login');
    Route::post('/resetPassword', 'resetPassword');
});
