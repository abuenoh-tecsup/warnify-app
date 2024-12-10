<?php

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;

// Ruta para la página "Acerca de"

Route::middleware('auth')->group(function () { // Protegemos estas rutas
    Route::get('/', [ReporteController::class, 'index']);
    Route::get('/inicio', [ReporteController::class, 'index'])->name('reportes.inicio');
    Route::get('/reportes/{filter?}/{state?}/{order?}/{id?}', [ReporteController::class, 'list_details_all'])->name('reportes.list');

    Route::get('/nuevo_reporte', [ReporteController::class, 'create'])->name('reportes.create');
    Route::post('/nuevo_reporte', [ReporteController::class, 'store'])->name('reportes.store');
    Route::get('/mapa', function () { return view('mapa'); });
    Route::get('/editar_reporte/{id}', [ReporteController::class, 'edit'])->name('reportes.edit');
    Route::put('/editar_reporte/{id}', [ReporteController::class, 'update'])->name('reportes.update');

    Route::get('/moderar_reporte/{id}', [ReporteController::class, 'edit_moderador'])->name('reportes.edit_moderador');
    Route::put('/moderar_reporte/{id}', [ReporteController::class, 'update_moderador'])->name('reportes.update_moderador');

    Route::get('/resolver_reporte/{id}', [ReporteController::class, 'edit_autoridad'])->name('reportes.edit_autoridad');
    Route::put('/resolver_reporte/{id}', [ReporteController::class, 'update_autoridad'])->name('reportes.update_autoridad');

    Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios.index');
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

    // Nuevas rutas para editar y actualizar comentarios
    Route::get('/comentarios/editar/{id}', [ComentarioController::class, 'edit'])->name('comentarios.edit');
    Route::put('/comentarios/actualizar/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');

    // Ruta para mostrar el formulario de cuenta
    Route::get('/cuenta', [CuentaController::class, 'show'])->name('cuenta.index');

    // Ruta para actualizar los datos de la cuenta
    Route::patch('/cuenta', [CuentaController::class, 'update'])->name('cuenta.update');

    // Ruta para cambiar la contraseña de la cuenta
    Route::patch('/cuenta/change-password', [CuentaController::class, 'changePassword'])->name('cuenta.changePassword');
    Route::get('/cuenta', [CuentaController::class, 'showestados'])->name('cuenta.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


