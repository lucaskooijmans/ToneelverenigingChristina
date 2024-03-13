<?php

use App\Http\Controllers\BestuursledenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardMemberController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('bestuursleden', BestuursledenController::class)->names([
    'store' => 'bestuursleden.store',
    'index' => 'bestuursleden.index',
    // Define other names if necessary
]);

