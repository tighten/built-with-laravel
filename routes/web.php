<?php

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Support\Facades\Route;

Route::view('/', 'orgs-list')->name('home');
Route::view('about', 'about')->name('about');
Route::get('orgs/{organization}', function (Organization $organization) {
    return view('organizations.show', ['organization' => $organization]);
})->name('organizations.show');

require __DIR__ . '/auth.php';

Route::get('{technology}', function (Technology $technology) {
    return view('orgs-list', ['filterTechnology' => $technology->slug]);
})->name('technologies.show');

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/

