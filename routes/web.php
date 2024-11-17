<?php
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () { // Protegemos estas rutas
    Route::get('/', [ReporteController::class, 'index']);
    Route::get('/inicio', [ReporteController::class, 'index'])->name('reportes.inicio');
    Route::get('/reportes/{id?}', [ReporteController::class, 'list_details_all'])->name('reportes.list');
    Route::get('/nuevo_reporte', [ReporteController::class, 'create'])->name('reportes.create');
    Route::post('/nuevo_reporte', [ReporteController::class, 'store'])->name('reportes.store');
    Route::get('/mapa', function () { return view('mapa'); });
    Route::get('/cuenta', function () { return view('cuenta'); });
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
