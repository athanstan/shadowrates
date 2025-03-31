<?php

use App\Livewire\Deck\DeckCollection;
use App\Models\Deck;
use App\Models\User;
use Livewire\Livewire;

test('deck collection component can render', function () {
    // Create a user
    $user = User::factory()->create();

    // Create some test decks
    Deck::factory()->count(3)->create([
        'user_id' => $user->id,
        'is_public' => true,
    ]);

    // Test if the component renders successfully
    Livewire::test(DeckCollection::class)
        ->assertStatus(200)
        ->assertSee('Your Decks');
});
