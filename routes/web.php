<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $orgs = Organization::query()->get();

    return view('welcome', [
        'orgs' => $orgs,
    ]);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
