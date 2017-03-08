<?php
use Illuminate\Http\Request;
use App\Like;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/
// user APIs
Route::post('register', 'APIController@register');
Route::post('login', 'APIController@login');
// like APIs
Route::get('nbrlikebypost', 'LikeController@get_nbr_like_by_post');
Route::get('userslikebypost', 'LikeController@get_users_like_by_post');
// comment APIs
Route::get('nbrcommentsbypost', 'CommentController@get_nbr_comments_by_post');
Route::get('userscommentsbypost', 'CommentController@get_users_comments_by_post');
// tag APIs
Route::get('alltags', 'TagController@get_all_tags');
// post tag
Route::get('tagsbypost', 'TagController@get_tags_by_post');
// Group middleware
Route::group(['middleware' => 'jwt.auth'], function () {
// user APIs
    Route::get('user', 'APIController@get_user_details');
    Route::put('user', 'APIController@update');
    Route::delete('user', 'APIController@destroy');
// post APIs
    Route::post('post', 'PostController@store');
    Route::get('post', 'PostController@get_posts_by_user');
    Route::put('post/{post}', 'PostController@update');
    Route::delete('post/{post}', 'PostController@destroy');
    Route::get('postsbyfollowing', 'PostController@get_posts_by_following');
// event APIs
    Route::post('event', 'EventController@store');
    Route::put('event/{event}', 'EventController@update');
    Route::delete('event/{event}', 'EventController@destroy');
// event participation APIs
    Route::post('participation', 'ParticipationController@store');
    Route::delete('participation/{participation}', 'ParticipationController@destroy');
// comment APIs
    Route::post('comment', 'CommentController@store');
    Route::put('comment/{comment}', 'CommentController@update');
    Route::delete('comment/{comment}', 'CommentController@destroy');
// post like APIs
    Route::post('like', 'LikeController@store');
    Route::delete('like/{like}', 'LikeController@destroy');
// tag APIs
    Route::post('tag', 'TagController@store');
// post tag APIs
    Route::post('tagpost', 'TagPostController@store');
    Route::put('tagpost/{tagpost}', 'TagPostController@update');
    Route::delete('tagpost/{tagpost}', 'TagPostController@destroy');
// follow APIs
    Route::post('follow', 'FollowController@store');
    Route::delete('follow/{follow}', 'FollowController@destroy');
    Route::get('followingbyuser', 'FollowController@get_following_by_user');
    Route::get('followerbyuser', 'FollowController@get_follower_by_user');
});