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

Route::get('/main', [MainController::class, 'getMainPage'])->middleware('user.auth');
Route::get('/active-tasks', [TaskController::class, 'getActiveTasks'])->middleware('user.auth');
Route::get('/done-tasks', [TaskController::class, 'getDoneTasks'])->middleware('user.auth');

Route::get('/add-task', function () {
    return view('addingTask');
})->middleware('user.auth');
Route::post('/add-task', [TaskController::class, 'addTask']);
Route::get('/delete-task/{id}', [TaskController::class, 'deleteTask'])->middleware('user.auth');
Route::get('/done-task/{id}', [TaskController::class, 'doneTask'])->middleware('user.auth');

Route::get('/edit-task/{id}', [TaskController::class, 'editTaskForm'])->middleware('user.auth');
Route::post('/edit-task/{id}', [TaskController::class, 'editTask']);

Route::get('/history/{id}', [TaskController::class, 'getHistory'])->middleware('user.auth');

Route::get('/add-comment/{id}', [TaskController::class, 'getAddCommentForm'])->middleware('user.auth');
Route::post('/add-comment/{id}', [TaskController::class, 'addComment']);
Route::get('/comments/{id}', [TaskController::class, 'getComments'])->middleware('user.auth');
Route::get('/delete-comment/{id}', [TaskController::class, 'deleteComment']);

Route::get('/edit-comment/{id}', [TaskController::class, 'editCommentForm'])->middleware('user.auth');
Route::post('/edit-comment/{id}', [TaskController::class, 'editComment']);

Route::get('/signout', [UserController::class, 'signOut']);
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
