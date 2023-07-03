<?php

use Illuminate\Support\Facades\Route;
use VendorName\Skeleton\UI\API\Controllers\SingleNameController;

Route::get('/skeleton_without_prefix', [SingleNameController::class, 'index']);
Route::get('/skeleton_without_prefix/{id}', [SingleNameController::class, 'show']);
