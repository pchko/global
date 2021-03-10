<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'/article'], function(){
	Route::get('/{idArticle?}','ArticleController@show')->name('article.show');
	Route::post('/','ArticleController@store')->name('article.store');
	Route::put('/{idArticle}','ArticleController@update')->name('article.update');
	Route::delete('/{idArticle}','ArticleController@destroy')->name('article.destroy');
});

Route::group(['prefix'=>'/comment'], function(){
	Route::get('/{idComment?}','CommentController@show')->name('comment.show');
	Route::post('/','CommentController@store')->name('comment.store');
	Route::put('/{idComment}','CommentController@update')->name('comment.update');
	Route::delete('/{idComment}','CommentController@destroy')->name('comment.destroy');
});
