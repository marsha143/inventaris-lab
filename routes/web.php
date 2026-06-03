<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return redirect()->route('inventaris.index');
    });

    // Inventaris - semua dalam satu resource, pisah middleware di controller
    Route::get('/inventaris', [InventarisController::class, 'index'])
        ->name('inventaris.index');

    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    Route::get('/kondisi', [KondisiController::class, 'index'])
        ->name('kondisi.index');

    Route::middleware('admin')->group(function () {
        Route::resource('inventaris', InventarisController::class)
            ->except(['index']);  // hanya index yang di luar

        Route::resource('kategori', KategoriController::class)
            ->except(['index', 'show']);

        Route::resource('kondisi', KondisiController::class)
            ->except(['index', 'show']);

        Route::resource('users', UserController::class);
    });
});