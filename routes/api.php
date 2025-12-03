<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);



Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('user',UserController::class);
    Route::apiResource('patient',PatientController::class);
    Route::apiResource('appointment',AppointmentController::class);
    Route::apiResource('evaluation',EvaluationController::class);
    Route::post('profile/image',[ProfileController::class,'updateAvatar']);

    Route::controller(AuthController::class)
    ->group(function()
    {

        Route::post('/logout',[AuthController::class,'logout']);

        Route::prefix('email/verify')->group(function(){

            Route::get('/send',[AuthController::class,'sendVerificationEmail'])->name('sendEmailVerification');
            Route::get('/{id}/{hash}',[AuthController::class,'verify'])->name('verifiction.verify');

        });
    });
    Route::controller(NotificationController::class)->prefix('notification')
    ->group(function()
    {

        Route::get('/index','index');
        Route::get('/unread','unread');
        Route::post('/read/{id}','markAsRead');
        Route::post('/read','markAllAsRead');
        Route::delete('{id}','delete');
     
    });
   
    Route::controller(ReportController::class)->prefix('patient')
    ->group(function()
    {

        Route::get('/excel','export');
        Route::get('/report','report');
        Route::post('/import','import');

    });
}); 
