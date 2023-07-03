<?php

use Illuminate\Support\Facades\Route;
use AdminKit\Documents\UI\API\Controllers\DocumentController;

Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/documents/{id}', [DocumentController::class, 'show']);
