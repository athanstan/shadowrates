<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Livewire\CardCollection;
use App\Livewire\DeckBuilder;
use App\Livewire\Card\CardProfile;
use App\Livewire\User\UserProfile;
use App\Livewire\User\UserSettings;
use App\Livewire\User\UserWishlistIndex;
use App\Livewire\Wishlist\WishlistProfile;
use App\Livewire\Deck\DeckProfile;
use App\Livewire\Deck\DeckCollection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name('home');

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
Route::get('/users/{slug}/wishlists', UserWishlistIndex::class)->name('users.wishlists');

// User Settings (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', UserSettings::class)->name('users.settings');
});

// Deck Routes
Route::prefix('/decks')->name('decks.')->group(function () {
    Route::get('/', DeckCollection::class)->name('index');
    Route::get('/create', DeckBuilder::class)->name('create');
    Route::get('/{deck}/edit', DeckBuilder::class)->name('edit');
    Route::get('/{slug}', DeckProfile::class)->name('show');
});

// Wishlist Routes
Route::get('/wishlists/{slug}', WishlistProfile::class)->name('wishlists.show');
