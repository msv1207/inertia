<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TreeController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\GoogleSocialiteController;


Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::view('/login2', 'auth/login');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('test', TreeController::class);





Route::post('/search', function(Request $request) {
    Post::addAllToIndex();
    $articles = Post::searchByQuery(['match' => ['title' => $request->search]]);

    return $articles;
})->name('search');

Route::resource('posts', PostController::class);

require __DIR__.'/auth.php';
