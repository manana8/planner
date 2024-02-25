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
Route::get('/delete-task/{id}', [TaskController::class, 'deleteTask']);
Route::get('/done-task/{id}', [TaskController::class, 'doneTask']);

Route::get('/edit-task/{id}', [TaskController::class, 'editTaskForm']);
Route::post('/edit-task/{id}', [TaskController::class, 'editTask']);

Route::get('/history/{id}', [TaskController::class, 'getHistory']);

Route::get('/add-comment/{id}', [TaskController::class, 'getAddCommentForm']);
Route::post('/add-comment/{id}', [TaskController::class, 'addComment']);
Route::get('/comments/{id}', [TaskController::class, 'getComments']);
Route::get('/delete-comment/{id}', [TaskController::class, 'deleteComment']);

Route::get('/signout', [UserController::class, 'signOut']);
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
