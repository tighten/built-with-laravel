<?php

use App\Http\Controllers\SuggestOrganizationController;
use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('orgs/{organization}', function (Organization $organization) {
    return view('organizations.show', ['organization' => $organization]);
})->name('organizations.show');

Route::get('suggest', function () {
    return view('suggestions.create', ['technologies' => Technology::orderBy('name')->get()]);
})->name('suggestions.create');

Route::post('suggest', SuggestOrganizationController::class)->name('suggestions.store');

require __DIR__ . '/auth.php';

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/
