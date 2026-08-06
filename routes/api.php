<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/news', [ApiController::class, 'getNews']);
Route::get('/gospel/today', [ApiController::class, 'getTodayGospel']);
Route::get('/schedule/weekly', [ApiController::class, 'getWeeklySchedule']);
Route::get('/schedule/current', [ApiController::class, 'getCurrentSchedule']);
Route::post('/donations/checkout', [ApiController::class, 'donationCheckout']);
Route::post('/donations/pay-card', [ApiController::class, 'donationPayCard']);
