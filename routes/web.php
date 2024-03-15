<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    switch (auth()->user()->role) {
        case 'admin':
            return redirect('/admin/dashboard');
        case 'editor':
            return redirect('/editor/dashboard');
        default:
            return redirect('/');
    }

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/editor/dashboard', [AdminController::class, 'index2']); 
});


// Category Routegit 
Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/create/category', [CategoryController::class, 'create']);
Route::get('/admin/store/category', [CategoryController::class, 'store']);
Route::get('/admin/edit/category', [CategoryController::class, 'edit']);
Route::get('/admin/update/category', [CategoryController::class, 'update']);
Route::get('/admin/destroy/category', [CategoryController::class, 'destroy']);









require __DIR__.'/auth.php';
