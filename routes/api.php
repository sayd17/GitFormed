<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\RepositoryController;
use \App\Http\Controllers\Api\GuestController;
use \App\Http\Controllers\Api\MyRepositoryController;
use \App\Http\Controllers\Api\WatcherController;
use \App\Http\Controllers\Api\PullRequestController;
use \App\Models\User;
use \App\Models\Watcher;
use \App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Controller;
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
        // dd($request->all());
        return $request->user(); 
    });
    Route::apiResource('/users', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResources([
    '/myrepositories' => MyRepositoryController::class,
    '/repositories' => RepositoryController::class,
    '/watchers' => WatcherController::class,
    '/pullrequests' => PullRequestController::class,
    '/notifications' => NotificationController::class,
]);

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::resource('/guestRepositories', GuestController::class)->only(['index', 'show']);

Route::get('/soft-delete', [UserController::class, 'softDelete']);


    // Route::get('/soft-delete', function(){
//     $user = User::onlyTrashed()->get();

//     return $user;
// });
