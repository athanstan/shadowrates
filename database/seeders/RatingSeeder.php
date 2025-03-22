<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Deck;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure we have users
        if (User::count() === 0) {
            User::factory()->count(5)->create();
        }

        $users = User::all();
        $cards = Card::all();
        $decks = Deck::all();

        // Create card ratings (each user rates about 10 random cards)
        foreach ($users as $user) {
            $cardsToRate = $cards->random(min(10, $cards->count()));

            foreach ($cardsToRate as $card) {
                Rating::factory()
                    ->forCard($card)
                    ->create([
                        'user_id' => $user->id,
                    ]);
            }
        }

        // Create deck ratings (each user rates public decks from other users)
        foreach ($users as $user) {
            // Only rate decks from other users that are public
            $decksToRate = $decks->where('user_id', '!=', $user->id)
                ->where('is_public', true);

            // If there are any decks to rate
            if ($decksToRate->count() > 0) {
                // Rate up to 5 decks, or as many as are available
                $decksToRate = $decksToRate->random(min(5, $decksToRate->count()));

                foreach ($decksToRate as $deck) {
                    Rating::factory()
                        ->forDeck($deck)
                        ->create([
                            'user_id' => $user->id,
                        ]);
                }
            }
        }
    }
}
