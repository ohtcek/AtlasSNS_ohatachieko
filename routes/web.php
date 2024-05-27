<?php

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::group(
  ['middleware' => ['auth']],
  function () {
    Route::get('/top', 'PostsController@index');

    Route::get('/profile/{id}', 'UsersController@profile');

    Route::post('/top', 'PostsController@postCreate');

    Route::post('/post/update', 'PostsController@update');
    // 更新処理の時はidいらない

    Route::get('/top/{id}/delete/', 'PostsController@delete');
    // 削除

    Route::get('/search', 'UsersController@search');
    Route::post('/search', 'UsersController@search');


    Route::get('/top/{id}/follow', 'FollowsController@follow');
    Route::get('/top/{id}/unfollow', 'FollowsController@unfollow');
    // フォロー部分

    Route::get('/follow-list', 'PostsController@followList');
    Route::get('/follower-list', 'PostsController@followerList');

    Route::get('/follow-list/{id}/profile', 'FollowsController@followUser');
    // フォローリストからプロフィールへの遷移

    Route::post('/profile', 'UsersController@update');



    // ログアウト機能
    Route::get('/logout', 'Auth\LoginController@logout');
    // getとpostでそれぞれ一つのURL
  }
);
