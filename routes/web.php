<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
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

// projects
Route::get('/projects', [ProjectController::class, 'index'])->middleware('auth')->name('projects.index');
Route::get('/project/{id}', [ProjectController::class, 'show'])->middleware('auth')->name('projects.show');
Route::get('/projects/create', [ProjectController::class, 'create'])->middleware('auth')->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'store'])->middleware('auth')->name('projects.store');
Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->middleware('auth')->name('projects.edit');
Route::patch('/projects/update/{id}', [ProjectController::class, 'update'])->middleware('auth')->name('projects.update');
Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->middleware('auth')->name('projects.delete');

// issues
Route::get('/issues', [IssueController::class, 'index'])->middleware('auth')->name('issues.index');
Route::get('/issues/create', [IssueController::class, 'create'])->middleware('auth')->name('issues.create');
Route::post('/issues/store', [IssueController::class, 'store'])->middleware('auth')->name('issues.store');
Route::get('/issues/search', [IssueController::class, 'search'])->middleware('auth')->name('issues.search');
Route::get('/issues/{id}', [IssueController::class, 'show'])->middleware('auth')->name('issues.show');
Route::get('/issues/edit/{id}', [IssueController::class, 'edit'])->middleware('auth')->name('issues.edit');
Route::patch('/issues/update/{id}', [IssueController::class, 'update'])->middleware('auth')->name('issues.update');
Route::delete('/issues/delete/{id}', [IssueController::class, 'destroy'])->middleware('auth')->name('issues.delete');

// tags
Route::get('/tags', [TagController::class, 'index'])->middleware('auth')->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->middleware('auth')->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->middleware('auth')->name('tags.store');
Route::delete('/tags/delete/{id}', [TagController::class, 'destroy'])->middleware('auth')->name('tags.delete');
Route::post('/issues/{issue}/tags', [IssueController::class, 'attachTag'])->middleware('auth')->name('tags.attach');
Route::delete('/issues/{issue}/tags/{tag}', [IssueController::class, 'detachTag'])->middleware('auth')->name('tags.detach');

Route::get('/issues/{issue}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/issues/{issue}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/issues/{issue}/assign', [IssueController::class, 'assignUser'])->middleware('auth')->name('issues.assign');
Route::delete('/issues/{issue}/assign/{user}', [IssueController::class, 'unassignUser'])->middleware('auth')->name('issues.unassign');

require __DIR__.'/auth.php';
