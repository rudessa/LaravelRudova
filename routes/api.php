<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CommentController;

Route::prefix('v1')->group(function () {
    
    Route::apiResource('categories', CategoryController::class);
    
    Route::apiResource('posts', PostController::class);
    
    Route::apiResource('tags', TagController::class);
    
    Route::apiResource('comments', CommentController::class);
    
});