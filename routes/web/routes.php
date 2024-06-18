<?php

declare(strict_types=1);

use App\Models\Apps;
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

        /** end route for users */

        /** routes for manage tenant */
        Route::middleware(['auth'])->group(static function (): void {
            Route::view('tenants', 'pages.admin.tenants.index')->name('tenants');
        });

        Route::middleware(['auth'])->group(static function (): void {
            Route::view('tenants/create', 'pages.admin.tenants.create')->name('tenants.create');
        });

        /** pour gerer les application */
        Route::middleware(['auth'])->group(static function (): void {
            Route::view('apps', 'pages.admin.apps.index')->name('apps');
        });

        Route::get('apps/{id}/details', function (Apps $app, $id) {

            $app = Apps::find($id);
            return view('pages.admin.apps.details', compact('app'));
        })->name('apps.edit');

        Route::middleware(['auth'])->group(static function (): void {
            Route::view('modules', 'pages.admin.modules.index')->name('modules');
        });

        Route::middleware(['auth'])->group(static function (): void {
            Route::view('abonnements', 'pages.admin.abonnements.index')->name('abonnements');
        });

    });
}
