<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 random cards
        Card::factory()->count(50)->create();

        // Create some specific cards
        $predefinedCards = [
            [
                'name' => 'Dragon Oracle',
                'cost' => 2,
                'attack' => null,
                'defense' => null,
                'card_type' => 'Spell',
                'rarity' => 'Bronze',
                'class' => 'Dragoncraft',
                'ability_text' => 'Gain an empty play point orb.',
                'image_url' => 'https://shadowverse-portal.com/image/card/en/C_101424010.png',
            ],
            [
                'name' => 'Goblin',
                'cost' => 1,
                'attack' => 1,
                'defense' => 2,
                'card_type' => 'Follower',
                'rarity' => 'Bronze',
                'class' => 'Neutral',
                'ability_text' => null,
                'image_url' => 'https://shadowverse-portal.com/image/card/en/C_101011010.png',
            ],
            [
                'name' => 'Albert, Levin Champion',
                'cost' => 5,
                'attack' => 3,
                'defense' => 5,
                'card_type' => 'Follower',
                'rarity' => 'Legendary',
                'class' => 'Swordcraft',
                'ability_text' => 'Storm. Enhance (9): Can attack 2 times per turn. Evolve: +2/+0.',
                'image_url' => 'https://shadowverse-portal.com/image/card/en/C_104221010.png',
            ],
        ];

        foreach ($predefinedCards as $cardData) {
            Card::create($cardData);
        }
    }
}
