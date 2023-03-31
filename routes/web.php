<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\CarController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\DisplacementController;
use App\Http\Controllers\Web\TypeController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/', app()->getLocale().'/login');

Route::middleware(["auth", "role:admin|super_admin"])
    ->prefix('{lang}')
    ->where(['lang' => '[a-zA-Z]{2}'])
    ->middleware('lang')
    ->group(function () {

        Auth::routes();

        Route::get('/home', [HomeController::class, 'index'])
            ->name('home')
            ->middleware("role:admin|super_admin");
        /**
         * define all user's route
         */
        Route::prefix('users')->group(function () {
            Route::get('index', [UserController::class, 'index'])->name('user_index');
            Route::get('create', [UserController::class, 'create'])->name('user_create');
            Route::get('/{id?}/show', [UserController::class, 'show'])->name('user_show');
            Route::post('store', [UserController::class, 'store'])->name('user_store');
            Route::get('/{id?}/edit', [UserController::class, 'edit'])->name('user_edit');
            Route::put('/{id?}/update', [UserController::class, 'update'])->name('user_update');
            Route::post('/{id?}/delete', [UserController::class, 'destroy'])->name('user_delete');
            Route::post('/{id?}/restore', [UserController::class, 'restore'])->name('user_restore');
            Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
            Route::get('/edit_profile', [UserController::class, 'edit_profile'])->name('user_edit_profile');
            Route::post('/change_pass', [UserController::class, 'change_pass'])->name('user_change_pass');
        });

        Route::prefix('cars')->group(function () {
            Route::get('index', [CarController::class, 'index'])->name('car_index');
            Route::get('create', [CarController::class, 'create'])->name('car_create');
            Route::get('/{id?}/show', [CarController::class, 'show'])->name('car_show');
            Route::post('store', [CarController::class, 'store'])->name('car_store');
            Route::get('/{id?}/edit', [CarController::class, 'edit'])->name('car_edit');
            Route::put('/{id?}/update', [CarController::class, 'update'])->name('car_update');
            Route::post('/{id?}/delete', [CarController::class, 'destroy'])->name('car_delete');
            Route::delete('/delete_img', [CarController::class, 'removeImage'])->name('car_delete_img');
        });

        Route::prefix('types')->group(function () {
            Route::get('index', [TypeController::class, 'index'])->name('type_index');
            Route::get('create', [TypeController::class, 'create'])->name('type_create');
            Route::get('/{id?}/show', [TypeController::class, 'show'])->name('type_show');
            Route::post('store', [TypeController::class, 'store'])->name('type_store');
            Route::get('/{id?}/edit', [TypeController::class, 'edit'])->name('type_edit');
            Route::put('/{id?}/update', [TypeController::class, 'update'])->name('type_update');
            Route::post('/{id?}/delete', [TypeController::class, 'destroy'])->name('type_delete');
            Route::post('/{id?}/restore', [TypeController::class, 'restore'])->name('type_restore');
        });

        Route::prefix('cities')->group(function () {
            Route::get('index', [CityController::class, 'index'])->name('city_index');
            Route::get('create', [CityController::class, 'create'])->name('city_create');
            Route::get('/{id?}/show', [CityController::class, 'show'])->name('city_show');
            Route::post('store', [CityController::class, 'store'])->name('city_store');
            Route::get('/{id?}/edit', [CityController::class, 'edit'])->name('city_edit');
            Route::put('/{id?}/update', [CityController::class, 'update'])->name('city_update');
            Route::post('/{id?}/delete', [CityController::class, 'destroy'])->name('city_delete');
            Route::post('/{id?}/restore', [CityController::class, 'restore'])->name('city_restore');
        });

        Route::prefix('displacements')->group(function () {
            Route::get('index', [DisplacementController::class, 'index'])->name('displacement_index');
            Route::get('create', [DisplacementController::class, 'create'])->name('displacement_create');
            Route::get('/{id?}/show', [DisplacementController::class, 'show'])->name('displacement_show');
            Route::post('store', [DisplacementController::class, 'store'])->name('displacement_store');
            Route::get('/{id?}/edit', [DisplacementController::class, 'edit'])->name('displacement_edit');
            Route::put('/{id?}/update', [DisplacementController::class, 'update'])->name('displacement_update');
            Route::post('/{id?}/delete', [DisplacementController::class, 'destroy'])->name('displacement_delete');
            Route::post('/{id?}/restore', [DisplacementController::class, 'restore'])->name('displacement_restore');
        });

    });
