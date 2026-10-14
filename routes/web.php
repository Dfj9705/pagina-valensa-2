<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');

Route::view('/productos', 'pages.products')
    ->name('products.index');
