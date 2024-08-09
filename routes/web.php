<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SuggestionsController;
use Illuminate\Support\Facades\Route;

Route::redirect('login', 'bts/login')->name('login');

Route::resource('organizations', OrganizationController::class)->only('show')->middleware('page-cache');
Route::resource('suggestions', SuggestionsController::class)->only(['create', 'store']);
Route::get('{technology:slug?}', [OrganizationController::class, 'index'])->name('home')->middleware('page-cache');
