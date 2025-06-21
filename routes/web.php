<?php

use Illuminate\Support\Facades\Route;
// Laravel facade and helper functions
Route::view('/', 'home')->name('home');
Route::view('contact', 'contact')->name('contact');
Route::get('admin/products', function () {
    return view('admin.products.index');
})->name('admin.products');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
