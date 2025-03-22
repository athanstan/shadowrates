<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Rating;
use App\Models\User;

it('can create a card rating', function () {
    $user = User::factory()->create();
    $card = Card::factory()->create();

    $rating = Rating::factory()->forCard($card)->create([
        'user_id' => $user->id,
        'rating_value' => 4.5,
        'comment' => 'Great card!',
    ]);

    expect($rating)->toBeInstanceOf(Rating::class)
        ->and($rating->user_id)->toBe($user->id)
        ->and($rating->card_id)->toBe($card->id)
        ->and($rating->deck_id)->toBeNull()
        ->and($rating->rating_value)->toBe(4.5)
        ->and($rating->comment)->toBe('Great card!');
});

it('can create a deck rating', function () {
    $user = User::factory()->create();
    $deckOwner = User::factory()->create();
    $deck = Deck::factory()->create(['user_id' => $deckOwner->id]);

    $rating = Rating::factory()->forDeck($deck)->create([
        'user_id' => $user->id,
        'rating_value' => 3.5,
        'comment' => 'Decent deck',
    ]);

    expect($rating)->toBeInstanceOf(Rating::class)
        ->and($rating->user_id)->toBe($user->id)
        ->and($rating->card_id)->toBeNull()
        ->and($rating->deck_id)->toBe($deck->id)
        ->and($rating->rating_value)->toBe(3.5)
        ->and($rating->comment)->toBe('Decent deck');
});

it('can fetch rating relationships', function () {
    $user = User::factory()->create();
    $card = Card::factory()->create();

    $rating = Rating::factory()->forCard($card)->create([
        'user_id' => $user->id,
    ]);

    expect($rating->user->id)->toBe($user->id)
        ->and($rating->card->id)->toBe($card->id);
});
