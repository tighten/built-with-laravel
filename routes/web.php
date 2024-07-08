<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('orgs/{organization}', function (Organization $organization) {
    return view('organizations.show', ['organization' => $organization]);
})->name('organizations.show');
Route::view('suggest', 'suggestions.create')->name('suggestions.create');

require __DIR__ . '/auth.php';

Route::view('{technology}', 'technologies.show')->name('technologies.show');

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/

