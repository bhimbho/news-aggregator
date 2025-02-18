<?php

use Illuminate\Support\Facades\Route;

Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index']);