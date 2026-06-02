<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/', function () {
        return redirect()->route('inventaris.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Inventaris
    |--------------------------------------------------------------------------
    | Admin & Staff bisa lihat
    */

    Route::get('/inventaris', [InventarisController::class, 'index'])
        ->name('inventaris.index');

    Route::get('/inventaris/{inventari}', [InventarisController::class, 'show'])
        ->name('inventaris.show');

    /*
    |--------------------------------------------------------------------------
    | Kategori
    |--------------------------------------------------------------------------
    | Admin & Staff bisa lihat
    */

    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    /*
    |--------------------------------------------------------------------------
    | Kondisi
    |--------------------------------------------------------------------------
    | Admin & Staff bisa lihat
    */

    Route::get('/kondisi', [KondisiController::class, 'index'])
        ->name('kondisi.index');

    /*
    |--------------------------------------------------------------------------
    | Admin Only
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        // Inventaris CRUD
        Route::resource('inventaris', InventarisController::class)
            ->except(['index', 'show']);

        // Kategori CRUD
        Route::resource('kategori', KategoriController::class)
            ->except(['index', 'show']);

        // Kondisi CRUD
        Route::resource('kondisi', KondisiController::class)
            ->except(['index', 'show']);

        // User CRUD
        Route::resource('users', UserController::class);
    });
});