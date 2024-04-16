<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});
Route::get('/details', function () {return view('details/details');});
Route::get('/contact', function () {return view('contact');});