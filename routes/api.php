<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RepaymentController;

Route::post('/loans', [LoanController::class, 'store']);
Route::post('/loans/{loan}/repayments', [RepaymentController::class, 'store']);
Route::get('/loans/{loan}', [LoanController::class, 'show']);
