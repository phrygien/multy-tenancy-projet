<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('accee_school', 'pages.tenants.schools.accee')->name('school');
Route::view('anneescolaires', 'pages.tenants.anneescolaires.index')->name('anneescolaires');
Route::view('cycles', 'pages.tenants.cycles.index')->name('cycles');
Route::view('eleves', 'pages.tenants.eleves.index')->name('eleves');
