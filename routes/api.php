<?php

use App\Http\Controllers\SlackInteractivityController;
use App\Http\Middleware\VerifySlackSignature;
use Illuminate\Support\Facades\Route;

Route::post('slack/interactivity', SlackInteractivityController::class)
    ->middleware(VerifySlackSignature::class);
