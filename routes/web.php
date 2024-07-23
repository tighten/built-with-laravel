<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SuggestionsController;
use Illuminate\Support\Facades\Route;

Route::resource('organizations', OrganizationController::class)->only('show')->middleware('page-cache');
Route::resource('suggestions', SuggestionsController::class)->only(['create', 'store']);

require __DIR__.'/auth.php';

Route::get('{technology:slug?}', [OrganizationController::class, 'index'])->name('home')->middleware('page-cache');

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/
