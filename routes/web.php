<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AemGroupController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HtmlCleanerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageManipulationController;

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

Route::get('/', function () {
    return Inertia::render('Home');
});


Route::get('image-manipulator', [ImageManipulationController::class, 'index']);
Route::get('html-cleaner', [HtmlCleanerController::class, 'index']);
Route::post('html-cleaner', [HtmlCleanerController::class, 'store']);

Route::get('/aem-groups', [AemGroupController::class, 'index']);
Route::post('/aem-groups', [AemGroupController::class, 'create']);

Route::get('/components', [ComponentController::class, 'index'])->name('components.index');
Route::post('/components/{component}', [ComponentController::class, 'update']);
