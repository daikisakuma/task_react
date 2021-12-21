<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/react_basic', 'App\Http\Controllers\ReactBasicController@reactTodo')->name('react.basic');

Route::post('/register_todo', 'App\Http\Controllers\ReactBasicController@registerTodo')->name('register.todo');

Route::get('/load_todo', 'App\Http\Controllers\ReactBasicController@loadTodo')->name('load.todo');

Route::post('/delete_todo', 'App\Http\Controllers\ReactBasicController@deleteTodo')->name('delete.todo');

Route::post('/status_change_todo', 'App\Http\Controllers\ReactBasicController@statusChangeTodo')->name('status.change.todo');
