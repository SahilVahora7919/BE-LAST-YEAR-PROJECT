<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RazorpayController;

Route::get('/', [HomeController::class, 'index']);

// User Dashboard

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

//Product Details
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

//Add Product In cart
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

//Show Product in cart
Route::get('/show_cart', [HomeController::class, 'show_cart']);

//Remove Product In Cart
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

//Checkout
Route::get('/checkout', [HomeController::class, 'checkout'])->name('home.checkout');
Route::post('/checkout', [HomeController::class, 'store'])->name('checkout.store');

// Cart Update
Route::post('/cart/{id}/update', [HomeController::class, 'updateCart'])->name('cart.update');

// Route for adding a product to favorites
Route::post('/add_wishlist/{id}', [HomeController::class, 'add_wishlist'])->name('add_wishlist');

// Route for viewing favorite products
Route::get('/wishlist', [HomeController::class, 'show_wishlist'])->name('show_wishlist');

// Route for removing a product from favorites
Route::get('/remove_wishlist/{product_id}', [HomeController::class, 'remove_wishlist'])->name('remove_wishlist');

// Search 
Route::get('/product_search', [HomeController::class, 'product_search']);

//User Order
Route::get('/show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

// Shop View
Route::get('/shop', [HomeController::class, 'shop']);

// Conatct View
Route::get('/contact', [HomeController::class, 'contact']);

Route::post('/processed-to-pay', [RazorpayController::class, 'processToPay']);

Route::post('/store-order-data', [RazorpayController::class, 'storeOrderData']);

// Admin Routes 

// Add Category 
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

// add products 
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);

// show products
Route::get('/show_product', [AdminController::class, 'show_product']);

// delete products
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

// update products
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

// Order
Route::get('/order', [AdminController::class, 'order']);

// Status Change
Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

// Download Invoice 
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

// Routes for viewing and adding banners
Route::get('/banners', [AdminController::class, 'view_banner'])->name('admin.banners');
Route::post('/banners', [AdminController::class, 'add_banner'])->name('admin.banners');
Route::get('/delete_banner/{id}', [AdminController::class, 'delete_banner']);

// show users
Route::get('/users', [AdminController::class, 'view_users'])->name('admin.users');
Route::get('/delete_users/{id}', [AdminController::class, 'delete_users'])->name('admin.delete_users');
Route::get('/update_users/{id}', [AdminController::class, 'update_users'])->name('admin.update_users');
Route::post('/update_users_confirm/{id}', [AdminController::class, 'update_users_confirm'])->name('admin.update_users_confirm');

