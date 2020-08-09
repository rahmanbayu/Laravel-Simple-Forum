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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
});
Route::resource('discussions', 'DiscussionController');
Route::resource('discussions/{discussion}/replies', 'ReplyController');

Route::get('users/notifications', 'UserController@notifications')->name('users.notifications');
Route::post('discussions/{discussion}/replies/{reply}/best-reply', 'DiscussionController@bestReply')->name('discussions.bestreply');
