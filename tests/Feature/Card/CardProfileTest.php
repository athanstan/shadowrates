<?php

use App\Livewire\Card\CardProfile;
use App\Models\Card;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use Livewire\Livewire;

test('card profile component can render', function () {
    // Create necessary related models for a card
    $cardType = CardType::factory()->create();
    $craft = Craft::factory()->create();
    $cardSet = CardSet::factory()->create();

    // Create a card with minimal required attributes to match the schema
    $card = Card::factory()->create([
        'card_type_id' => $cardType->id,
        'craft_id' => $craft->id,
        'card_set_id' => $cardSet->id,
        'main_type' => 'follower',
        'effects' => 'Some card effect text',
        'atk' => 2,
        'health' => 3,
    ]);

    // Test if the component renders successfully
    Livewire::test(CardProfile::class, ['card' => $card])
        ->assertSuccessful()
        ->assertSee($card->name);
});
