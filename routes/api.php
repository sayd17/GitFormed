<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\RepositoryController;
use \App\Http\Controllers\Api\GuestController;
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

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/user', function (Request $request) {
        // dd($request);
        return $request->user(); 
    });
    Route::apiResources([
        '/users' => UserController::class,
        '/repositories' => RepositoryController::class,

    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/guestRepositories', [RepositoryController::class, 'guest']);
