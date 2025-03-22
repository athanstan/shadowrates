<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Rating;
use App\Models\User;

it('can create a card', function () {
    $card = Card::factory()->create();

    expect($card)->toBeInstanceOf(Card::class)
        ->and($card->id)->toBeGreaterThan(0);
});

it('can fetch card relationships', function () {
    $card = Card::factory()->create();
    $user = User::factory()->create();
    $deck = Deck::factory()->create(['user_id' => $user->id]);

    // Add card to deck
    $deck->cards()->attach($card->id, ['quantity' => 2]);

    // Add rating to card
    $rating = Rating::factory()->forCard($card)->create(['user_id' => $user->id]);

    // Test relationships
    expect($card->decks)->toHaveCount(1)
        ->and($card->decks->first()->id)->toBe($deck->id)
        ->and($card->ratings)->toHaveCount(1)
        ->and($card->ratings->first()->id)->toBe($rating->id);
});

it('can calculate average rating', function () {
    $card = Card::factory()->create();
    $users = User::factory()->count(3)->create();

    // Create ratings with specific values
    Rating::factory()->forCard($card)->create([
        'user_id' => $users[0]->id,
        'rating_value' => 3.0,
    ]);

    Rating::factory()->forCard($card)->create([
        'user_id' => $users[1]->id,
        'rating_value' => 4.0,
    ]);

    Rating::factory()->forCard($card)->create([
        'user_id' => $users[2]->id,
        'rating_value' => 5.0,
    ]);

    // Expected average: (3 + 4 + 5) / 3 = 4.0
    expect($card->getAverageRatingAttribute())->toBe(4.0);
});
