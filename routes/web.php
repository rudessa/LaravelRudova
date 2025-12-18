<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\WebCommentController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/post/{slug}', [PageController::class, 'showPost'])->name('post.show');

Route::get('/category/{slug}', [PageController::class, 'showCategory'])->name('category.show');

Route::get('/tag/{slug}', [PageController::class, 'showTag'])->name('tag.show');

Route::post('/post/{slug}/comment', [WebCommentController::class, 'store'])->name('comment.store');

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/data', [FormController::class, 'showData'])->name('data.show');