<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function() {

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/validate', [AuthController::class, 'validate'])->middleware("auth:sanctum")->name('validate'); // make it post for password

    Route::post('/oauth', [AuthController::class, 'oauth'])->name('oauth');

});
