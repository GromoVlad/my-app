<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Messages\ListMessageController;
use App\Http\Controllers\Securities\ListSecurityController;
use App\Http\Controllers\Securities\StoreSecurityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth/'], function () {
    Route::post('register', [RegistrationController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('messages/list', [ListMessageController::class, 'list']);

    Route::get('securities', [ListSecurityController::class, 'list']);
    Route::post('securities', [StoreSecurityController::class, 'store']);
});
