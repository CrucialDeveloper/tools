<?php

use App\User;
use Illuminate\Support\Facades\Route;

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

// if (app('env') != "testing") {
//     auth()->loginUsingId(1);
// }

Route::auth();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/clients', 'ClientController@index')->name('clients.index');
    Route::get('/clients/{client}', 'ClientController@show')->name('clients.show');
    Route::post('/clients', 'ClientController@store')->name('clients.store');
    Route::patch('/clients/{client}', 'ClientController@update')->name('clients.update');
    Route::delete('/clients/{client}', 'ClientController@destroy')->name('clients.destroy');

    Route::get('/clients/{client}/projects', 'ClientProjectController@index');
    Route::get('/clients/{client}/projects/{project}', 'ClientProjectController@show');
    Route::post('/clients/{client}/projects', 'ClientProjebillablectController@store');
    Route::patch('/clients/{client}/projects/{project}', 'ClientProjectController@update');
    Route::delete('/clients/{client}/projects/{project}', 'ClientProjectController@destroy');

    Route::post('/clients/{client}/projects/{project}/tasks', 'TaskController@store');
    Route::patch('/clients/{client}/projects/{project}/tasks/{task}', 'TaskController@update');
    Route::post('/task/{task}', 'TaskStatusController@update');

    Route::post('clients/{client}/projects/{project}/comments', 'CommentController@store');
    Route::patch('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@destroy');

    Route::post('/clients/{client}/projects/{project}/workentry', 'WorkEntryController@store');
    Route::patch('/clients/{client}/projects/{project}/workentry/{entry}', 'WorkEntryController@update');
    Route::delete('/clients/{client}/projects/{project}/workentry/{entry}', 'WorkEntryController@destroy');


    Route::get('/projects', 'ProjectController@index');
});
