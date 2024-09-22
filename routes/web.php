<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Control Panel */
Route::prefix(config('control-panel.router.prefix'))
    ->name('cp.')
    ->middleware('verified')
    ->group(function (): void {

        /* Control Panel Authentication - Registration, Login and Logout */
        Route::name('auth.')
            ->controller(AuthController::class)
            ->withoutMiddleware('verified')
            ->middleware('guest')
            ->group(function (): void {

                Route::get('/register', 'create')->name('create');

                Route::post('/register', 'store')->name('store');

                Route::get('/login', 'show')->name('show');

                Route::post('/login', 'login')->name('login');

                Route::post('/logout', 'logout')
                    ->withoutMiddleware('guest')
                    ->middleware('auth')
                    ->name('logout');

            });

        /* Control Panel Dashboard and Rescources */
        Route::middleware('auth')->group(function (): void {

            Route::controller(DashboardController::class)->group(function (): void {

                Route::get('/dashboard', 'show')->name('dashboard');

            });

            Route::resource('users', UserController::class);

            Route::resource('pages', PageController::class)->except('show');

        });

    });

Route::prefix(config('control-panel.router.prefix'))->group(function (): void {
    /* User E-Mail verification */
    Route::prefix('/user-verification')
        ->name('verification.')
        ->controller(VerificationController::class)
        ->middleware('auth')
        ->group(function (): void {
            
            // Todo: Middleware to redirect to Front or CMS user dashboard
            Route::get('/', 'create')->name('notice');
            
            Route::post('/', 'store')->name('send');
            
            Route::get('/{id}/{hash}', 'update')->middleware('signed')->name('verify');
            
        });
    
    /* User Password reset */
    Route::prefix('/password-reset')
        ->name('password.')
        ->controller(PasswordResetController::class)
        ->middleware('guest')
        ->group(function (): void {
            
            Route::get('/', 'create')->name('request');
            
            Route::post('/', 'store')->name('email');
            
            // Todo: middleware to redirect to recovery request page if token and email in the url are invalid
            Route::get('/{token}', 'edit')->name('reset');
            
            Route::post('/update', 'update')->name('update');
            
        });

    /* Fallback Control Panel route - Redirect to the closest existing route or dashboard */
    Route::get('/{foo?}')->where(['foo' => '.*'])->middleware('cp.redirect')->name('cp.');
});

/* Frontpage - Handles any public page URL */
Route::get('/{permalink?}', [PageController::class, 'show'])->where(['permalink' => '.*'])->name('pages.show');