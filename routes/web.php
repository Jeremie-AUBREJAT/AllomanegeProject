<?php

use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PictureController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// route pour creer carousel et picture en meme temps
Route::post('/carousel/create', [CarouselController::class, 'createCarouselAndPicture']);

// Route Picture
Route::get('/picture/edit', [PictureController::class, 'editPicture']);
Route::get('/picture/create', [PictureController::class, 'create']);
Route::post('/picture/create', [PictureController::class, 'createPicture']);
// Route Category
Route::get('/category/edit', [CategoryController::class, 'editCategory']);
Route::get('/category/create', [CategoryController::class, 'create']);
Route::post('/category/create', [CategoryController::class, 'createCategory']);
Route::get('/category/update/{id}', [CategoryController::class, 'update']);
Route::put('/category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/category/{id}', [CategoryController::class, 'destroyCategory']);
// Route Carousel
Route::get('/carousel/view', [CarouselController::class, 'home']);
Route::get('/carousel/create', [CarouselController::class, 'viewCreateCarousel']);
Route::post('/carousel/create', [CarouselController::class, 'createCarousel']);
Route::get('/carousel/update/{id}', [CarouselController::class, 'viewUpdateForm']);
Route::put('/update/{id}', [CarouselController::class, 'updateCarousel']);
Route::delete('/carousel/{id}', [CarouselController::class, 'destroyCarousel']);

// Route::get('/', function () {return view('home');});
Route::get('/', [CarouselController::class, 'homeFront']);
// Route::get('/manèges', function () {return view('carousels');});
Route::get('/manèges', [CarouselController::class, 'carouselsFront']);
// Route::get('/détails', function () {return view('details/details');});
Route::get('manège/détails/{id}',[CarouselController::class, 'detailsFront']);
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
