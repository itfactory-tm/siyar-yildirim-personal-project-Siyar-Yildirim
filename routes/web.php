<?php

use App\Http\Middleware\ActiveUser;
use App\Http\Middleware\Admin;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\Suppliers;
use App\Livewire\Admin\Users;
use App\Livewire\Basket;
use App\Livewire\Shop;
use App\Livewire\User\History;
use Illuminate\Support\Facades\Route;

// Laravel facade and helper functions
Route::view('/', 'home')->name('home');
Route::view('contact', 'contact')->name('contact');
Route::get('shop', Shop::class)->name('shop');
Route::get('basket', Basket::class)->name('basket');

Route::middleware(['auth', Admin::class, ActiveUser::class])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/products');
    Route::get('categories', Categories::class)->name('categories');
    Route::get('products', Products::class)->name('products');
    Route::get('users', Users::class)->name('users');
    Route::get('orders', Orders::class)->name('orders');
    Route::get('suppliers', Suppliers::class)->name('suppliers');
});

Route::middleware(['auth', ActiveUser::class])->prefix('user')->name('user.')->group(function () {
    Route::redirect('/', '/user/history');
    Route::get('history', History::class)->name('history');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ActiveUser::class,])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
});
