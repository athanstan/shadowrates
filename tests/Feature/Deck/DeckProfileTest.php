<?php

use App\Livewire\Deck\DeckProfile;
use App\Models\Craft;
use App\Models\Deck;
use App\Models\User;
use Livewire\Livewire;

test('deck profile component can render', function () {
    // Create necessary related models
    $user = User::factory()->create();

    // Create a test deck
    $deck = Deck::factory()->create([
        'user_id' => $user->id,
        'name' => 'Test Deck',
        'description' => 'A test deck for the DeckProfile component test',
        'is_public' => true,
        'format' => 1,
    ]);

    // Test if the component renders successfully
    Livewire::test(DeckProfile::class, ['deck' => $deck])
        ->assertStatus(200)
        ->assertSee('Test Deck');
});
