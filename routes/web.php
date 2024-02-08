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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top', 'PostsController@index');

Route::get('/profile', 'UsersController@profile');

Route::post('/top', 'PostsController@postCreate');

// Route::post('/top', 'PostsController@show');
// 投稿の表示で作ったけど特別作らなくても表示できるぽい

Route::post('/post/update', 'PostsController@update');
// 更新処理の時はidいらない

Route::get('/top/{id}/delete/', 'PostsController@delete');
// 削除

Route::get('/search', 'UsersController@index');

Route::get('/follow-list', 'PostsController@follow');
Route::get('/follower-list', 'PostsController@follower');

// ログアウト機能
Route::get('/logout', 'Auth\LoginController@logout');
// getとpostでそれぞれ一つのURL
