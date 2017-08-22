<?php
use App\Status;
use App\Post;
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

Route::get('/home', 'HomeController@index')->name('home');

    Route::resource("profile",'ProfileController');
    Route::get("/add_friend/{id}","FriendController@add_friend");
    Route::get("/accept_friend/{id}","FriendController@accept_friend");
    Route::get("/check/{id}","FriendController@check");
    Route::get("/unread",function(){
        return Auth::user()->unreadNotifications;
    });
    Route::get("/notifications",'HomeController@notifications');

    Route::resource('post', 'PostController');
    Route::get("/all_status",function(){
        return Status::all();
    });
    Route::get("/feed","FeedController@feed");
    Route::get("/auth_user_data",function(){
        return Auth::user();
    });
    Route::get("/like/{id}","LikeController@like");
    Route::get("/unlike/{id}",'LikeController@unlike');
    Route::get("/count/{id}","LikeController@count");
    Route::get("/comment/{id}","CommentController@index");
    Route::post("/add_comment","CommentController@create");
    Route::get("/my_posts","FeedController@my_posts");