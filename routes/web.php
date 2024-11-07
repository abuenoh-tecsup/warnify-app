<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/inicio', function () {return view('inicio');});
Route::get('/mis_reportes', function () {return view('mis_reportes');});
Route::get('/nuevo_reporte', function () {return view('nuevo_reporte');});
Route::get('/mapa', function () {return view('mapa');});
Route::get('/cuenta', function () {return view('cuenta');});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
