<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('home');});
Route::get('/manèges', function () {return view('carousels/carousels');});
Route::get('/détails', function () {return view('details/details');});
Route::get('/contact', function () {return view('contact');});
Route::get('/mentionslégales', function () {return view('mentionslegales');});
Route::get('/cgv', function () {return view('cgv');});