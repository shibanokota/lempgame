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
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/post', 'PostController');
Route::post('\post\comment\store','CommentController@store')->name('comment.store');
Route::get('/mypost','HomeController@mypost')->name('home.mypost');
Route::get('/mycomment','HomeController@mycomment')->name('home.mycomment');
//プロファイルの編集
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');
//いいね機能
Route::post('/like/{postId}','LikeController@store');
Route::post('/unlike/{postId}','LikeController@destroy');

//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('ajaxlike', 'PostsController@ajaxlike')->name('posts.ajaxlike');
});
//管理者用
Route::middleware(['can:admin'])->group(function() {
//ユーザ一覧
Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
Route::delete('/profile/delete/{user}', 'ProfileController@delete')->name('profile.delete');

});