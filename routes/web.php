<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkEntryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\ClientProjectController;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::patch('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::get('/clients/{client}/projects', [ClientProjectController::class, 'index']);
    Route::get('/clients/{client}/projects/{project}', [ClientProjectController::class, 'show']);
    Route::post('/clients/{client}/projects', [ClientProjectController::class, 'store']);
    Route::patch('/clients/{client}/projects/{project}', [ClientProjectController::class, 'update']);
    Route::delete('/clients/{client}/projects/{project}', [ClientProjectController::class, 'destroy']);

    Route::post('/clients/{client}/projects/{project}/tasks', [TaskController::class, 'store']);
    Route::patch('/clients/{client}/projects/{project}/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/clients/{client}/projects/{project}/tasks/{task}', [TaskController::class, 'destroy']);
    Route::post('/task/{task}', [TaskStatusController::class, 'update']);

    Route::post('clients/{client}/projects/{project}/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::post('/clients/{client}/projects/{project}/workentry', [WorkEntryController::class, 'store']);
    Route::patch('/clients/{client}/projects/{project}/workentry/{entry}', [WorkEntryController::class, 'update']);
    Route::delete('/clients/{client}/projects/{project}/workentry/{entry}', [WorkEntryController::class, 'destroy']);

    Route::get('/projects', [ProjectController::class, 'index']);
});
