<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
/*
Route::get('/', function () {
    return view('template.admin.master');
});

Route::get('/forum', function () {
    return view('template.forum.master');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','QuestionController@index');
Route::get('/question/create','QuestionController@create')->middleware('auth');
Route::post('/question/store','QuestionController@store')->middleware('auth');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});