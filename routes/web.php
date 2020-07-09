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
    return view('template.forum.forum');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','QuestionController@index');
// Route::get('/question/create','QuestionController@create')->middleware('auth');
// Route::post('/question/store','QuestionController@store')->middleware('auth');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/question/create','QuestionController@create');
    Route::post('/question/store','QuestionController@store');
    Route::get('/question/{id}','QuestionController@show');

    Route::post('/answer/store','AnswerController@store');
    
    Route::get('/answerComment/show/{id}','AnswerCommentController@show');
    Route::post('/answerComment/store','AnswerCommentController@store');

    Route::get('/questionComment/show/{id}','QuestionCommentController@show');
    Route::post('/questionComment/store','QuestionCommentController@store');
    Route::get('/vote/answer/{id}', 'VoteAnswerController@vote');
});

Route::get('/forum', 'QuestionController@index');

Route::get('/master', function(){
    return view('template.admin.master');
});