<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::get('/registrate', [UserController::class, 'getRegistrate']);
Route::post('/registrate', [UserController::class, 'postRegistrate']);

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin']);
