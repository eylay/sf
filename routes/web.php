<?php

use Illuminate\Support\Facades\Route;

// default laravel routes
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// dashboard routes
Route::resource('shop', 'ShopController')->except('show');
Route::resource('product', 'ProductController')->except('show');
Route::resource('order', 'OrderController')->only(['index', 'destroy']);
Route::post('product/{id}/restore', 'ProductController@restore')->name('product.restore');


// public routes
Route::get('landing/{page}', 'LandingController@loadPage')->name('landing');
Route::get('landing/shop/{shop}', 'LandingController@showShop')->name('shop.show');

// cart routes
Route::post('cart/manage/{product}', 'CartController@manage')->name('cart.manage');
Route::post('cart/finish', 'CartController@finish')->name('cart.finish');
Route::delete('cart/{cart_item}', 'CartController@remove')->name('cart.remove');
