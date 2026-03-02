<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/todo/create', function () {
    return view('components.create-todo');
})->name('create-todo');
