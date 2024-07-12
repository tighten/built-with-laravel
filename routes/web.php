<?php

use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\SuggestOrganizationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::resource('organizations', OrganizationsController::class)->only(['show']);
Route::resource('suggestions', SuggestOrganizationController::class)->only(['create', 'store']);

require __DIR__ . '/auth.php';

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/
