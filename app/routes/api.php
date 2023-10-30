<?php

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

Route::get('/', function () {
    return (['msg' => 'Hello, world!']);
});

Route::controller(UserController::class)->group(function () 
{
    Route::post('/register', 'store');
    Route::post('/delete', 'delete');
    Route::post('/update', 'update');
    Route::get('/getUsers', 'getAll');
    Route::get('/getUser', 'getUser');
});

Route::controller(PetsController::class)->group(function () 
{
    Route::post('/registerPet', 'store');
});
