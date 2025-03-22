<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Livewire\CardCollection;
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

// Card Routes
Route::get('/cards', function () {
    return view('cards.index');
})->name('cards.index');
Route::get('/cards/{card}', function ($card) {
    return view('cards.show', ['card' => \App\Models\Card::findOrFail($card)]);
})->name('cards.show');
