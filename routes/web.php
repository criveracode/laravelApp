<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::controller(PageController::class)->group(function () {

    Route::get('/', 'home')->name('home');

    Route::get('blog/{post:slug}', 'post')->name('post');
});


Route::redirect('dashboard','posts')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta que apunta a las publicaciones
Route::resource('posts', PostController::class)->middleware(['auth', 'verified'])->except('show');

require __DIR__.'/auth.php';
