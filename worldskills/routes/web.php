<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JustController;
use App\Http\Controllers\ContentController;


Route::get('/register', 'App\Http\Controllers\RegisterController@register')->name('register');
Route::post('/register', 'App\Http\Controllers\RegisterController@index');


Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@index');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


Route::get('/profile', 'App\Http\Controllers\JustController@profile')->middleware(['auth'])->name('profile');

Route::get('/admin', 'App\Http\Controllers\JustController@admin')->middleware(['auth'])->name('admin');



Route::get('/create', 'App\Http\Controllers\ContentController@create')->name('content');
Route::post('/create', 'App\Http\Controllers\ContentController@store')->name('store');
Route::get('/', 'App\Http\Controllers\ContentController@index')->name('dashboard');
Route::get('/content/{slug}', 'App\Http\Controllers\ContentController@show')->middleware(['auth'])->name('show');

Route::get('/content/{content}/edit', 'App\Http\Controllers\ContentController@edit')->name('edit');
Route::put('/content/{content}', 'App\Http\Controllers\ContentController@update')->name('update');

Route::delete('/content/{content}', 'App\Http\Controllers\ContentController@destroy')->name('destroy');

Route::post('/admin/{user}/ban', 'App\Http\Controllers\JustController@banUser')->name('user-ban');



Route::get('/search', 'App\Http\Controllers\ContentController@search')->name('search');
Route::post('content/{id}/hide', 'App\Http\Controllers\ContentController@hide')->name('hide');


