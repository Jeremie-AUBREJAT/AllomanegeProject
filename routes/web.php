<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {return view('home');});
Route::get('/manèges', function () {return view('carousels/carousels');});
Route::get('/détails', function () {return view('details/details');});
Route::get('/contact', function () {return view('contact');});
Route::get('/mentionslégales', function () {return view('mentionslegales');});
Route::get('/cgv', function () {return view('cgv');});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
