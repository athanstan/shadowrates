<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Livewire\CardCollection;
use App\Livewire\User\UserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Google Sign-In Routes
Route::prefix('auth/google')->name('auth.google.')->group(function () {
    Route::get('redirect', [GoogleController::class, 'redirectToGoogle'])->name('redirect');
    Route::get('callback', [GoogleController::class, 'handleGoogleCallback'])->name('callback');
});

// Auth Routes
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Card Routes
Route::get('/cards', function () {
    return view('cards.index');
})->name('cards.index');
Route::get('/cards/{card}', function ($card) {
    return view('cards.show', ['card' => \App\Models\Card::findOrFail($card)]);
})->name('cards.show');

// User Routes
Route::get('/users/{slug}', UserProfile::class)->name('users.profile');
