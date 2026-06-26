<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
Route::get('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->middleware('auth')->name('projects.show');
Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [\App\Http\Controllers\ProjectController::class, 'store'])->middleware('auth')->name('projects.store');
Route::get('/project/edit/{id}', [\App\Http\Controllers\ProjectController::class, 'edit'])->middleware('auth')->name('projects.edit');
Route::patch('/projects/update/{id}', [\App\Http\Controllers\ProjectController::class, 'update'])->middleware('auth')->name('projects.update');
Route::delete('/projects/delete/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->middleware('auth')->name('projects.delete');

require __DIR__.'/auth.php';
