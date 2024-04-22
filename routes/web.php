<?php

use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BestuursledenController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SponsorCategoryController;
use App\Http\Controllers\TicketController;

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

// Performances page
Route::get('/voorstellingen', [PerformanceController::class, 'index'])->name('performances.index');
Route::get('/voorstellingen/create', [PerformanceController::class, 'create'])->name('performances.create');
Route::post('/voorstellingen', [PerformanceController::class, 'store'])->name('performances.store');
Route::get('/voorstellingen/{performance}/edit', [PerformanceController::class, 'edit'])->name('performances.edit');
Route::delete('/voorstellingen/delete/{id}', [PerformanceController::class, 'delete'])->name('performances.delete');
Route::get('/voorstellingen/{id}', [PerformanceController::class, 'show'])->name('performances.show');

// Calendar
Route::get('/agenda', [PerformanceController::class, 'calendar'])->name('performances.calendar');

// History page
Route::get('/historie', [HistoryController::class, 'index']);

// News page
Route::get('/nieuws', [PostController::class, 'index']);

// Photos resource
Route::resource('gallery', GalleryController::class);

// Posts resource
Route::resource('posts', PostController::class);

// Bestuursleden
// Route::get('/bestuursleden', [BestuursledenController::class, 'index']);
Route::resource('bestuursleden', BestuursledenController::class);
// Route::put('/bestuursleden/{bestuurslid}', [BestuursledenController::class, 'update'])->name('bestuursleden.update');

// Sponsors page
Route::resource('sponsors', SponsorController::class);
// TODO: Middleware voor admin alleen
Route::get('/sponsors/create', [SponsorController::class, 'create'])->name('sponsors.create');
Route::post('/sponsors/update-order', [SponsorController::class, 'updateOrder'])->name('sponsors.updateOrder');
Route::post('/sponsors/update-category', [SponsorController::class, 'updateCategory'])->name('sponsors.updateCategory');
Route::get('/sponsors/{id}/edit', [SponsorController::class, 'edit'])->name('sponsors.edit');
Route::put('/sponsors/{id}', [SponsorController::class, 'update'])->name('sponsors.update');
Route::delete('/sponsors/{sponsor}', [SponsorController::class, 'destroy'])->name('sponsors.destroy');

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

Route::get('/sponsorscategory/create', [SponsorCategoryController::class, 'create'])->name('sponsorcategory.create');
Route::post('/sponsorscategory', [SponsorCategoryController::class, 'store'])->name('sponsorcategory.store');

// Tickets routes
Route::get('/performances/{performance}/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/performances/{performance}/tickets', [TicketController::class, 'store'])->name('tickets.store');

// Admin Actions
Route::middleware('auth')->group(function () {
    Route::put('/performances/{performance}/update-ticket-amount', [PerformanceController::class, 'updateTicketAmount'])->name('performances.updateTicketAmount');
});

// Auth routes
require __DIR__ . '/auth.php';
