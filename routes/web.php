<?php

use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Plan\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TreeController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\GoogleCalendar\Event;

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
Route::resource('tree', TreeController::class);

Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('bd.pdf');


Route::resource('plans', PlanController::class);

Route::post('/search', [SearchController::class, 'index'])->name('search');
Route::post('/tag/{id}', [TagController::class, 'index'])->name('tag');

Route::resource('posts', PostController::class);
//Route::post('post/edit', PostController::class)

require __DIR__ . '/auth.php';
