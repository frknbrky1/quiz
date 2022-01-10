<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->get('/panel', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function() {

    /*Route::get('deneme', function() {
        return "prefix test";
    });*/

    /*Route::get('deneme', function() {
        return "middleware test";
    });*/
});