<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// SELLERS
Route::middleware('auth')->group(function () {
    Route::get('/sellers', [SellersController::class, 'index'])->name('sellers.index');
    Route::get('/sellers/{id}', [SellersController::class, 'show'])->name('sellers.show');
});

// EMAIL
Route::get('/email/resend/{id}', [EmailController::class, 'resend'])->name('email.resend');

// USERS
Route::get('/users', [UsersController::class, 'index'])
    ->middleware('auth')
    ->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
