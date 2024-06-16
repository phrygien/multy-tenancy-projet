<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->as('pages:')->group(static function (): void {

        Route::middleware(['guest'])->prefix('auth')->as('auth:')->group(static function (): void {
            Route::view('login', 'pages.admin.login')->name('login');
        });

        Route::middleware(['auth'])->group(static function (): void {
            Route::view('/', 'pages.index')->name('home');
        });

        Route::prefix('auth')->as('auth:')->group(static function (): void {
            Route::view('register', 'pages.admin.register')->name('register');
        });

        /** for managin users */
        Route::middleware(['auth'])->group(static function (): void {
            Route::view('users', 'pages.admin.users.index')->name('users');
        });

        Route::middleware(['auth'])->group(static function (): void {
            Route::view('users/create', 'pages.admin.users.create')->name('users.create');
        });

    });
}
