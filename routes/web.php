<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Route;

Route::view('/', 'orgs-list')->name('home');
Route::view('about', 'about')->name('about');
Route::get('orgs/{organization}', function (Organization $organization) {
    return view('organizations.show', ['organization' => $organization]);
})->name('organizations.show');

/*

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

*/

require __DIR__ . '/auth.php';

Route::get('{technology}', function ($technology) {
    return view('orgs-list', ['filterTechnology' => $technology]);
})->name('technologies.show'); // @todo Filter only to viable routes
