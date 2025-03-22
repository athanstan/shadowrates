<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'rating_value' => $this->faker->randomFloat(1, 1, 5),
            'comment' => $this->faker->boolean(70) ? $this->faker->paragraph() : null,
        ];
    }

    /**
     * Configure the model factory to rate a card.
     */
    public function forCard(Card $card = null): self
    {
        return $this->state(fn(array $attributes) => [
            'card_id' => $card ?? Card::factory(),
            'deck_id' => null,
        ]);
    }

    /**
     * Configure the model factory to rate a deck.
     */
    public function forDeck(Deck $deck = null): self
    {
        return $this->state(fn(array $attributes) => [
            'card_id' => null,
            'deck_id' => $deck ?? Deck::factory(),
        ]);
    }
}
