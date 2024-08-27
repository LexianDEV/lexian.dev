<?php

use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('', function () {
        return view('welcome', [
            'repositories' => cache()->get('github'),
            'profile' => cache()->get('github_profile'),
        ]);
    })->name('home');
});