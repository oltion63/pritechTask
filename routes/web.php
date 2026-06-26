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

//projects
Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
Route::get('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->middleware('auth')->name('projects.show');
Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [\App\Http\Controllers\ProjectController::class, 'store'])->middleware('auth')->name('projects.store');
Route::get('/project/edit/{id}', [\App\Http\Controllers\ProjectController::class, 'edit'])->middleware('auth')->name('projects.edit');
Route::patch('/projects/update/{id}', [\App\Http\Controllers\ProjectController::class, 'update'])->middleware('auth')->name('projects.update');
Route::delete('/projects/delete/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->middleware('auth')->name('projects.delete');


//issues
Route::get('/issues', [\App\Http\Controllers\IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/create', [\App\Http\Controllers\IssueController::class, 'create'])->name('issues.create');
Route::post('/issues/store', [\App\Http\Controllers\IssueController::class, 'store'])->middleware('auth')->name('issues.store');
Route::get('/issues/{id}', [\App\Http\Controllers\IssueController::class, 'show'])->middleware('auth')->name('issues.show');
Route::get('/issues/edit/{id}', [\App\Http\Controllers\IssueController::class, 'edit'])->middleware('auth')->name('issues.edit');
Route::patch('/issues/update/{id}', [\App\Http\Controllers\IssueController::class, 'update'])->middleware('auth')->name('issues.update');
Route::delete('/issues/delete/{id}', [\App\Http\Controllers\IssueController::class, 'destroy'])->middleware('auth')->name('issues.delete');


//tags
Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [\App\Http\Controllers\TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [\App\Http\Controllers\TagController::class, 'store'])->middleware('auth')->name('tags.store');
Route::delete('/tags/delete/{id}', [\App\Http\Controllers\TagController::class, 'destroy'])->middleware('auth')->name('tags.delete');
Route::post('/issues/{issue}/tags', [\App\Http\Controllers\IssueController::class, 'attachTag'])->middleware('auth')->name('tags.attach');
Route::delete('/issues/{issue}/tags/{tag}', [\App\Http\Controllers\IssueController::class, 'detachTag'])->middleware('auth')->name('tags.detach');


require __DIR__.'/auth.php';
