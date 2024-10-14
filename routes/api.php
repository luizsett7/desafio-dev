<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnabController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/cnab/upload', [CnabController::class, 'upload'])->name('upload');
Route::get('/cnab/parse/{filePath}', [CnabController::class, 'parse']);
Route::get('/cnab/transactions', [CnabController::class, 'listTransactions']);