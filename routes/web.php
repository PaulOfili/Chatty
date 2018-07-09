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



/**
 * Home
 */
// Route::get('/', function () {
//     return view('home');
// });

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home',
]);

Route::get('/alert', 'HomeController@alert'
);

/**
 * Authentication
 */

Route::get('/signup', [
    'uses' => 'AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'],
]);

Route::post('/signup', [
    'uses' => 'AuthController@postSignup',
    'middleware' => ['guest'],
]);

Route::get('/signin', [
    'uses' => 'AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest'],
]);

Route::post('/signin', [
    'uses' => 'AuthController@postSignin',
    'middleware' => ['guest'],
]);

Route::get('/signout', [
    'uses' => 'AuthController@getSignout',
    'as' => 'auth.signout',
]);

/**
 * Search
 */
Route::get('/search', [
    'uses' => 'SearchController@getResults',
    'as' => 'search.results',
]);

/**
 * User Profile
 */

 Route::get('/user/{username}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth'],
 ]);

 Route::get('/profile/edit', [
    'uses' => 'ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'],
]);

Route::post('/profile/edit', [
    'uses' => 'ProfileController@postEdit',
    'middleware' => ['auth'],
]);


/**
 * Friends
 */

 Route::get('/friends', [
     'uses' => 'FriendController@getIndex',
     'as' => 'friends.index',
     'middleware' => ['auth'],
 ] );

 Route::get('/friends/add/{username}', [
     'uses' => 'FriendController@getAdd',
     'as' => 'friend.add',
     'middleware' => ['auth'],
 ] );

 Route::get('/friends/accept/{username}', [
    'uses' => 'FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
] );

/**
 * Statuses
 */
Route::post('/status', [
    'uses' => 'StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
] );

Route::post('/status/{statusId}/reply', [
    'uses' => 'StatusController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth'],
] );

// Route::get('/home', 'HomeController@ind ex'
// )->name('home');





