<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')
    ->name('home');

Route::view('/quienes-somos', 'pages.about')
    ->name('about');

Route::view('/mision-vision', 'pages.mission-vision')
    ->name('mission-vision');

Route::view('/productos', 'pages.products')
    ->name('products.index');
