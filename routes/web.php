<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('role:finance')->prefix('finance')->name('finance.')->group(function () {
        Route::get('/dashboard', function () {
            return view('finance.dashboard');
        })->name('dashboard');
    });

    Route::middleware('role:payer')->prefix('payer')->name('payer.')->group(function () {
        Route::get('/dashboard', function (){
            return view('payer.dashboard');
        })->name('dashboard');
    });
});

Route::get('/', function () {
    return redirect('/login');
});




// Route::get('/', function () {
//     return view('welcome');
// });
