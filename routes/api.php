<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\Api\AuthController;

Route::get('/hora-servidor', function () {
    return response()->json([
        'datetime' => Carbon::now()->toDateTimeString(),
        'timestamp' => Carbon::now()->timestamp
    ]);
});

Route::post('/mobile-login', [AuthController::class, 'mobileLogin']);