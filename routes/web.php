<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TemplateController;



// Page de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// Page protégée par ton middleware personnalisé
Route::middleware('auth.custom')->group(function () {
    Route::get('/homepage', [TemplateController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

// Redirection '/' vers login
Route::get('/', function () {
    return redirect()->route('login');
});

