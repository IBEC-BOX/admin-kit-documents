<?php

use AdminKit\Documents\UI\API\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/documents/years', [DocumentController::class, 'years']);
Route::get('/documents/categories', [DocumentController::class, 'categories']);
