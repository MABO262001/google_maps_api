<?php

use App\Http\Controllers\ApisMapsController;
use App\Http\Controllers\GoogleMapsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas pertenecientes a los mapas
    Route::controller(GoogleMapsController::class)->group(function () {
        Route::get('/mapas', 'index')->name('mapa.index');
        Route::get('/mapas/create', 'create')->name('mapa.create');
        Route::get('/mapas/edit/{id}', 'edit')->name('mapa.edit');
        Route::post('/mapas/store', 'store')->name('mapa.store');
        Route::put('/mapas/update/{id}', 'update')->name('mapa.update');
        Route::delete('/mapas/destroy/{id}', 'destroy')->name('mapa.destroy');
    });

    Route::controller(ApisMapsController::class)->group(function(){
        Route::get('/apismaps', 'index')->name('api.index');
        Route::get('/apismaps/create', 'create')->name('api.create');
        Route::get('/apismaps/edit/{id}', 'edit')->name('api.edit');
        Route::post('/apismaps/store', 'store')->name('api.store');
        Route::put('/apismaps/update/{id}', 'update')->name('api.update');
        Route::delete('/apismaps/destroy/{id}', 'destroy')->name('api.destroy');
    });



});
