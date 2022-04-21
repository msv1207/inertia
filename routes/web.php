<?php

use App\Http\Controllers\Post\FilterController;
use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\PostSingleController;
use App\Http\Controllers\Post\MainCategoryController;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\Plan\PDFController;
use App\Http\Controllers\Plan\PlanController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\SearchController;
use App\Http\Controllers\Post\TagController;
use App\Http\Controllers\Post\TreeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::view('/login2', 'auth/login');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('tree', TreeController::class, [
    'only' => ['store', 'update'],
]);

Route::post('maincat', [MainCategoryController::class, 'store']);
Route::post('category', [CategoryController::class, 'store']);
Route::post('post', [PostSingleController::class, 'store']);

Route::post('/filter', [FilterController::class, 'index']);

Route::put('maincat/{id}', [MainCategoryController::class, 'update']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::put('post/{id}', [PostSingleController::class, 'update']);

Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('bd.pdf');

Route::resource('plans', PlanController::class);

//Route::get('search', [SearchController::class, 'index']);
Route::post('/search', [SearchController::class, 'index'])->name('search');
Route::post('/tag/{id}', [TagController::class, 'index'])->name('tag');

Route::resource('posts', PostController::class);
//Route::post('post/edit', PostController::class)

require __DIR__ . '/auth.php';
