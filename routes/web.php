<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

Route::get('/', [WishlistController::class, 'showForm'])->name('wishlist.form');
Route::post('/submit', [WishlistController::class, 'submitWishlist'])->name('wishlist.submit');
Route::get('/pick', [WishlistController::class, 'pickSecretBox'])->name('wishlist.pick');
Route::get('/pick/{id}', [WishlistController::class, 'pickName'])->name('wishlist.pickName');
