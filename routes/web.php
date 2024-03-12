<?php

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

Route::resource('board_members', BoardMemberController::class)->names([
    'store' => 'board_members.store',
    'index' => 'board_members.index',
    // Define other names if necessary
]);

Route::get('/bestuursleden', function () {
    return view('bestuurleden');
});