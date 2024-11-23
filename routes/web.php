<?php

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;

// Ruta para la página "Acerca de"
Route::get('/acerca', function () {
    return view('acerca');
})->middleware('auth')->name('acerca');

Route::middleware('auth')->group(function () { // Protegemos estas rutas
    Route::get('/', [ReporteController::class, 'index']);
    Route::get('/inicio', [ReporteController::class, 'index'])->name('reportes.inicio');
    Route::get('/reportes/{filter?}/{id?}', [ReporteController::class, 'list_details_all'])->name('reportes.list');
    Route::get('/nuevo_reporte', [ReporteController::class, 'create'])->name('reportes.create');
    Route::post('/nuevo_reporte', [ReporteController::class, 'store'])->name('reportes.store');
    Route::get('/mapa', function () { return view('mapa'); });
    Route::get('/editar_reporte/{id}', [ReporteController::class, 'edit'])->name('reportes.edit');
    Route::put('/editar_reporte/{id}', [ReporteController::class, 'update'])->name('reportes.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/geocode', [GeoCodingController::class, 'searchAddress'])->name('geocode');

// Ruta para mostrar el formulario de cuenta
Route::get('/cuenta', [CuentaController::class, 'show'])->name('cuenta.index');

// Ruta para actualizar los datos de la cuenta
Route::patch('/cuenta', [CuentaController::class, 'update'])->name('cuenta.update');

// Ruta para cambiar la contraseña de la cuenta
Route::patch('/cuenta/change-password', [CuentaController::class, 'changePassword'])->name('cuenta.changePassword');
