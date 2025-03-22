<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Rating;
use App\Models\User;

it('can create a deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->create(['user_id' => $user->id]);

    expect($deck)->toBeInstanceOf(Deck::class)
        ->and($deck->id)->toBeGreaterThan(0)
        ->and($deck->user_id)->toBe($user->id);
});

it('can fetch deck relationships', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->create(['user_id' => $user->id]);
    $cards = Card::factory()->count(3)->create();

    // Add cards to deck with different quantities
    $deck->cards()->attach($cards[0]->id, ['quantity' => 1]);
    $deck->cards()->attach($cards[1]->id, ['quantity' => 2]);
    $deck->cards()->attach($cards[2]->id, ['quantity' => 3]);

    // Add rating to deck
    $ratingUser = User::factory()->create();
    $rating = Rating::factory()->forDeck($deck)->create(['user_id' => $ratingUser->id]);

    // Test relationships
    expect($deck->user->id)->toBe($user->id)
        ->and($deck->cards)->toHaveCount(3)
        ->and($deck->cards->pluck('id')->toArray())->toContain($cards[0]->id)
        ->and($deck->ratings)->toHaveCount(1)
        ->and($deck->ratings->first()->user_id)->toBe($ratingUser->id);

    // Test pivot data
    expect($deck->cards->find($cards[2]->id)->pivot->quantity)->toBe(3);
});

it('can calculate average rating', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->create(['user_id' => $user->id]);
    $users = User::factory()->count(3)->create();

    // Create ratings with specific values
    Rating::factory()->forDeck($deck)->create([
        'user_id' => $users[0]->id,
        'rating_value' => 2.0,
    ]);

    Rating::factory()->forDeck($deck)->create([
        'user_id' => $users[1]->id,
        'rating_value' => 3.0,
    ]);

    Rating::factory()->forDeck($deck)->create([
        'user_id' => $users[2]->id,
        'rating_value' => 4.0,
    ]);

    // Expected average: (2 + 3 + 4) / 3 = 3.0
    expect($deck->getAverageRatingAttribute())->toBe(3.0);
});
