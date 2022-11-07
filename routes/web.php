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
    Route::get('/posts/edit/{id}-{slug}','edit')->name('posts.edit');

    Route::post('/posts/store','store')->name('posts.store');

    Route::put('/posts/update/{id}-{slug}','update')->name('posts.update');

    Route::delete('/posts/delete/{id}-{slug}','destroy')->name('posts.delete');
});

Route::controller(App\Http\Controllers\Admin\CategoryController::class)->middleware(['auth', 'verified'])->group(function() {
    Route::get('/categories','index')->name('categories.index');
    Route::get('/categories/create','create')->name('categories.create');
    // Route::get('/categories/{slug}','show')->name('categories.show');
    Route::get('/categories/edit/{id}-{slug}','edit')->name('categories.edit');

    Route::post('/categories/store','store')->name('categories.store');

    Route::put('/categories/update/{id}-{slug}','update')->name('categories.update');

    Route::delete('/categories/delete/{id}-{slug}','destroy')->name('categories.delete');
});

Route::controller(App\Http\Controllers\Admin\AccountController::class)->middleware(['auth', 'verified'])->group(function() {
    Route::get('/account','index')->name('account.index');
    Route::put('/account/update/{id}','update')->name('account.update');

});

Route::controller(App\Http\Controllers\CommentController::class)->middleware(['auth', 'verified'])->group(function() {

    Route::post('/comments/store/{post_id}','store')->name('comments.store');
    Route::get('/comments/edit/{id}','edit')->name('comments.edit');
    Route::put('/comments/update/{id}}','update')->name('comments.update');
    Route::delete('/comments/delete/{id}','destroy')->name('comments.delete');

});



Route::get('/', [PageController::class, 'home']);

Route::fallback(function() {
    return view('404');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
