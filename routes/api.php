<?php

use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\DisplacementController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\UserController;
use App\Sockets\AlertWebsocket\AlertWebsocketHandler;
use App\Sockets\TripWebsocket\TripWebsocketHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

WebSocketsRouter::webSocket('create-alert', AlertWebsocketHandler::class);
WebSocketsRouter::webSocket('displacement', TripWebsocketHandler::class);

Route::middleware(['jwt', 'role:client|driver', 'cors'])
    // ->prefix('{lang}')->where(['lang' => '[a-zA-Z]{2}'])
    // ->middleware('lang')
    ->group(function () {

        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login'])
                ->withoutMiddleware(['role:client|driver', 'jwt']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh'])
                ->withoutMiddleware(['jwt', 'role:client|driver']);
        });

        Route::prefix('users')->group(function () {
            Route::get('nearby', [UserController::class, 'index']);
            Route::post('create', [UserController::class, 'store'])->withoutMiddleware(['jwt', 'role:client|driver']);;
            Route::get('{id}/show', [UserController::class, 'show']);
            Route::put('{id}/update', [UserController::class, 'update']);
            Route::delete('{id}/destroy', [UserController::class, 'destroy']);
        });

        Route::prefix('cars')->group(function () {
            Route::get('owner', [CarController::class, 'index']);
        });

        Route::prefix('alert')->group(function () {
            Route::post('create', [AlertController::class, 'store'])
                ->withoutMiddleware(['jwt', 'role:client|driver']);
        });

        Route::prefix('trip')->group(function () {
            Route::get('list', [DisplacementController::class, 'index']);
            Route::post('create', [DisplacementController::class, 'store']);
            Route::delete('{id}/delete', [DisplacementController::class, 'destroy']);
        });

        Route::prefix('notice')->group(function () {
            Route::get('list', [NoticeController::class, 'index']);
            Route::post('create', [NoticeController::class, 'store']);
        });
    });
