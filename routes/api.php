<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);



Route::middleware('auth:sanctum')
->group(function(){

    
    Route::apiResource('patient',PatientController::class);
    Route::apiResource('appointment',AppointmentController::class);
    Route::apiResource('evaluation',EvaluationController::class);
    Route::post('profile/image',[ProfileController::class,'updateAvatar']);
    Route::delete('profile/image',[ProfileController::class,'delete']);
    Route::post('appointment/suggest',[AppointmentController::class,'suggest']);
  

    Route::middleware('role:admin')
    ->group(function(){

        Route::apiResource('supervisor',SupervisorController::class);
        Route::apiResource('student',StudentController::class);
        Route::apiResource('receptionist',ReceptionistController::class);
        Route::apiResource('user',UserController::class);

    });


    Route::controller(AuthController::class)
    ->group(function()
    {

        Route::post('/logout',[AuthController::class,'logout']);

        Route::prefix('email/verify')->group(function(){

            Route::get('/send',[AuthController::class,'sendVerificationEmail'])->name('sendEmailVerification');
            Route::get('/{id}/{hash}',[AuthController::class,'verify'])->name('verifiction.verify')->middleware('signed');

        });
    });


    Route::controller(NotificationController::class)
    ->prefix('notification')
    ->group(function()
    {

        Route::get('/index','index');
        Route::get('/unread','unread');
        Route::post('/read/{id}','markAsRead');
        Route::post('/read','markAllAsRead');
        Route::delete('{id}','delete');
     
    });
   

    Route::controller(ReportController::class)
    ->prefix('patient')
    ->middleware('role:receptionist,admin','throttle:2')
    ->group(function()
    {

        Route::post('/excel','export');
        Route::post('/report','report');
        Route::post('/import','import');

    });
}); 
