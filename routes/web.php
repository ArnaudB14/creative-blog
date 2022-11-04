<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', fn() => view('dashboard'))->name('admin')->middleware('auth');

// Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
// Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
// Route::delete('/posts/delete', [AdminPostController::class, 'delete'])->name('posts.delete');
// Route::post('/posts/store', [AdminPostController::class, 'store'])->name('posts.store');
// Route::get('/posts/{slug}', [AdminPostController::class, 'show'])->name('posts.show');


Route::controller(App\Http\Controllers\Admin\PostController::class)->group(function() {
    Route::get('/posts','index')->name('posts.index');
    Route::get('/posts/create','create')->name('posts.create');
    Route::get('/posts/{id}-{slug}','show')->name('posts.show');
    Route::get('/posts/edit/{slug}','edit')->name('posts.edit');

    Route::post('/posts/store','store')->name('posts.store');

    Route::put('/posts/update/{slug}','update')->name('posts.update');

    Route::delete('/posts/delete/{slug}','destroy')->name('posts.delete');
});

Route::controller(App\Http\Controllers\Admin\CategoryController::class)->middleware(['auth', 'verified'])->group(function() {
    Route::get('/categories','index')->name('categories.index');
    Route::get('/categories/create','create')->name('categories.create');
    // Route::get('/categories/{slug}','show')->name('categories.show');
    Route::get('/categories/edit/{slug}','edit')->name('categories.edit');

    Route::post('/categories/store','store')->name('categories.store');

    Route::put('/categories/update/{slug}','update')->name('categories.update');

    Route::delete('/categories/delete/{slug}','destroy')->name('categories.delete');
});

Route::get('/', [PageController::class, 'home']);

Route::fallback(function() {
    return view('404');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
