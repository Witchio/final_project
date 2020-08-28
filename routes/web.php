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

//! Main page
Route::get('/', 'PostController@main')->name('main');


//!Posts pages

//* Posts routes
//Display all the posts
Route::get('/posts', 'PostController@index')->name('posts');
//Display 1 post
Route::get('/posts/{id}', 'PostController@show');


/* When using the url posts/create it creates an issue with posts/{id}, since it think create should be an id.
To fix this i changed the url to post/create.
Another 'fix' would have also been to move the route for posts/create above the posts/id* - Luchi */
//Create/store posts
// Redirects user if not logged in
Route::get('/post/create', 'PostController@create')->name('post.create')->middleware('auth');
Route::post('/post/create', 'PostController@store');


//. Reporting a post
Route::get('/post/report/{id}', 'PostController@report')->name('post.report')->middleware('auth');

//Deleting a post as an admin
//TODO User can do this without being admin
Route::get('/post/delete/{id}', 'PostController@destroy')->middleware('auth');

Route::get('/test', 'PostController@test'); // jo keep

//* Commments
//Route to add comment
Route::post('/posts/comment/{id}', 'CommentController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{id}', 'PostController@show');

// UPDATE posts jo
Route::get('/post/update/{editPostId}', 'PostController@edit')->middleware('auth');
Route::put('/post/update/{editPostId}', 'PostController@update');
// Redirects user if not logged in
Route::get('/post/update', function () {
    return redirect('/login');
})->middleware('auth');

// LIKE posts jo
Route::get('/post/like/{likePostId}', 'PostController@likePost')->middleware('auth');
// Redirects user if not logged in
Route::get('/post/like', function () {
    return redirect('/login');
})->middleware('auth');

//! Admin Dashboard
//* Users admin Dashboard
Route::get('/admin/users', 'HomeController@showUser')->name('admin-users');
//TODO LARAVEL ERROR WHEN ACCESSING THIS PAGE BY URL W/O LOGIN
Route::post('admin/userRole/{id}', 'HomeController@edit');
//TODO LARAVEL ERROR WHEN ACCESSING THIS PAGE BY URL W/O LOGIN
Route::post('/admin/delete/{id}', 'HomeController@destroy')->middleware('auth');

//* Posts Admin dashboard
Route::get('/admin/posts', 'PostController@showSoftDeleted')->name('admin-posts')->middleware('auth');
//TODO LARAVEL ERROR WHEN ACCESSING THIS PAGE BY URL W/O LOGIN
Route::delete('/admin/posts/delete/{id}', 'PostController@destroy');
//TODO LARAVEL ERROR WHEN ACCESSING THIS PAGE BY URL W/O LOGIN
Route::put('/admin/posts/restore/{id}', 'PostController@restore');

//! Profile dashboard
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
Route::get('/profile', 'HomeController@showProfile')->name('profile');
//TODO LARAVEL ERROR WHEN ACCESSING THIS PAGE BY URL W/O LOGIN
Route::put('/profile/update', 'HomeController@update');


//! Stats page

Route::get('statistics', function () {
    return view('statistics');
})->name('stats');

//! About us
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
