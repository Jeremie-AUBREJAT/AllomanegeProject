<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});
Route::get('/404', function () {return view('404');});
Route::get('/contact', function () {return view('contact');});