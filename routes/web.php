<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Livewire\CardCollection;
use App\Livewire\DeckBuilder;
use App\Livewire\Card\CardProfile;
use App\Livewire\User\UserProfile;
use App\Livewire\User\UserSettings;
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
Route::get('/cards', CardCollection::class)->name('cards.index');

Route::get('/cards/{card:slug}', CardProfile::class)->name('cards.show');

// User Routes
Route::get('/users/{slug}', UserProfile::class)->name('users.profile');

// User Settings (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', UserSettings::class)->name('users.settings');
});

// Deck Routes
Route::get('/decks', function () {
    return view('decks.index');
})->name('decks.index');

Route::get('/decks/create', DeckBuilder::class)->name('decks.create');

Route::get('/decks/{deck}/edit', DeckBuilder::class)->name('decks.edit');

Route::get('/decks/{deck}', function ($deck) {
    return view('decks.show', ['deck' => \App\Models\Deck::findOrFail($deck)]);
})->name('decks.show');
