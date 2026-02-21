<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FontController;

Route::get('/fonts', [FontController::class, 'allFonts']);
