<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TaskController;
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

Route::get('/registrate', [UserController::class, 'getRegistrate']);
Route::post('/registrate', [UserController::class, 'postRegistrate']);

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin']);

Route::get('/main', [MainController::class, 'getMainPage']);
Route::get('/active-tasks', [TaskController::class, 'getActiveTasks']);
Route::get('/done-tasks', [TaskController::class, 'getDoneTasks']);

Route::get('/add-task', function () {
    return view('addingTask');
});
Route::post('/add-task', [TaskController::class, 'addTask']);
Route::post('/delete-task', [TaskController::class, 'deleteTask']);
Route::get('/done-task', [TaskController::class, 'doneTask']);
