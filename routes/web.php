<?php

    use App\Http\Controllers\HistoryController;
    use App\Http\Controllers\PostController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProfileController;

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

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/historie', [HistoryController::class, 'index']);
Route::get('/nieuws', [PostController::class, 'index']);
Route::resource('posts', PostController::class);

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/history/create', function(){
    return view('history.create');
})->name('history.create');;

Route::post('/history/store', [HistoryController::class, 'store'])->name('history.store');
require __DIR__.'/auth.php';
