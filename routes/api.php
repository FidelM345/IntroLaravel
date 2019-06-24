<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List Articles
Route::get('articles','test\ArticlesController@index');

//List Single article
Route::get('articles/{id}','test\ArticlesController@show');

//create new article
Route::post('articles','test\ArticlesController@store');

//update article
Route::put('articles/{id}','test\ArticlesController@update');

//delete article
Route::delete('articles/{id}','test\ArticlesController@destroy');



//news article lists
Route::get('postlist','NewsApi\NewsController@index');



