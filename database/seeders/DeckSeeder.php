<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users if they don't exist
        if (User::count() === 0) {
            User::factory()->count(5)->create();
        }

        // Get users
        $users = User::all();

        // Create 10 decks
        $decks = Deck::factory()
            ->count(10)
            ->recycle($users)
            ->create();

        // Get cards to add to decks
        $cards = Card::all();

        // Populate each deck with 20-40 cards
        foreach ($decks as $deck) {
            // Get cards matching the deck class and neutral cards
            $deckCards = $cards->filter(function ($card) use ($deck) {
                return $card->class === $deck->class || $card->class === 'Neutral';
            });

            // If there are not enough cards, use any cards
            if ($deckCards->count() < 20) {
                $deckCards = $cards;
            }

            // Randomly select 15-25 unique cards
            $selectedCards = $deckCards->random(min(rand(15, 25), $deckCards->count()));

            // Attach cards to deck with quantities
            foreach ($selectedCards as $card) {
                $deck->cards()->attach($card->id, ['quantity' => rand(1, 3)]);
            }
        }
    }
}
