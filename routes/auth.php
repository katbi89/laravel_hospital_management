<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\DoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');


Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');
//######################################### Route User Login #########################//
Route::post('User/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest') ->name('login.user');

//######################################### Route Admin Login #########################//

Route::post('Admin/login', [AdminController::class, 'store'])
    ->middleware('guest') ->name('login.admin');

//#################################################################################//



//######################################### Route Admin Login #########################//

Route::post('Doctor/login', [DoctorController::class, 'store'])
    ->middleware('guest') ->name('login.doctor');

//#################################################################################//

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

//######################################### Route User Logout #########################//
Route::post('User/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout.user');
//#######################################################################################///


//######################################### Route Admin Logout #########################//
Route::post('Admin/logout', [AdminController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('logout.admin');
//#######################################################################################///
