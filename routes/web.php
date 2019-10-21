<?php

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

Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/clients', 'ClientController@index')->name('clients.index');
    Route::post('/clients', 'ClientController@store')->name('clients.store');
    Route::patch('/clients/{client}', 'ClientController@update')->name('clients.update');

    Route::post('/clients/{client}/projects', 'ProjectController@store');
    Route::patch('/clients/{client}/projects/{project}', 'ProjectController@update');
    Route::delete('/clients/{client}/projects/{project}', 'ProjectController@destroy');

    Route::post('/clients/{client}/projects/{project}/tasks', 'TaskController@store');
    Route::patch('/clients{client}/projects/{project}/tasks/{task}', 'TaskController@@update');
});
