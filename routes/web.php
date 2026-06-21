<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/story', 'story')->name('story');
Route::view('/companies', 'companies')->name('companies');
Route::view('/products', 'products')->name('products');
Route::view('/services', 'services')->name('services');
Route::view('/projects', 'projects')->name('projects');
Route::view('/branches', 'branches')->name('branches');
Route::view('/contact', 'contact')->name('contact');
Route::view('/news', 'news')->name('news');
