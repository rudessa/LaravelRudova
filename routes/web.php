<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;

// Главная страница
Route::get('/', [PageController::class, 'home'])->name('home');

// Страница с формой
Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');

// Страница с данными
Route::get('/data', [FormController::class, 'showData'])->name('data.show');