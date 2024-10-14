<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnabController;

Route::get('/', [CnabController::class, 'showUploadForm']);
Route::get('/cnab/upload', [CnabController::class, 'showUploadForm']);
Route::get('/cnab/list', [CnabController::class, 'list'])->name('cnab.list');