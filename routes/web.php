<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome page
Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/historie', [HistoryController::class, 'index']);

// News page
Route::get('/nieuws', [PostController::class, 'index']);

// Posts resource
Route::resource('posts', PostController::class);

// Contact page
Route::get('/contact', function () {
    return view('contact');
});


Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Home page
Route::get('/', function () {
    return view('home');
});

// Dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/history/create', [HistoryController::class, 'create'])->name('history.create');
Route::get('/history/edit/{id}', [HistoryController::class, 'edit'])->name('history.edit');
Route::delete('/history/delete/{id}', [HistoryController::class, 'delete'])->name('history.delete');

Route::post('/history/store', [HistoryController::class, 'store'])->name('history.store');

// Auth routes
require __DIR__ . '/auth.php';
