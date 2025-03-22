<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a name using random words
        $wordList = [
            'Ancient',
            'Dark',
            'Mystic',
            'Forest',
            'Dragon',
            'Shadow',
            'Sword',
            'Blood',
            'Haven',
            'Portal',
            'Rune',
            'Fairy',
            'Knight',
            'Wizard',
            'Necromancer',
            'Warrior',
            'Guardian',
            'Spirit',
            'Demon',
            'Angel',
            'Prince',
            'Princess',
            'King',
            'Queen',
            'Goblin',
            'Elf',
            'Golem',
            'Phoenix',
            'Wolf'
        ];

        // Manually select random words
        shuffle($wordList);
        $numWords = rand(1, 3);
        $selectedWords = array_slice($wordList, 0, $numWords);
        $name = ucwords(implode(' ', $selectedWords));

        $rarities = ['Bronze', 'Silver', 'Gold', 'Legendary'];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'effect' => $this->faker->text(),
            'evolved_effect' => $this->faker->boolean(70) ? $this->faker->text() : null,

            // Get or create dependencies
            'card_type_id' => function () {
                return CardType::factory()->create()->id;
            },
            'craft_id' => function () {
                return Craft::factory()->create()->id;
            },
            'card_set_id' => function () {
                return CardSet::factory()->create()->id;
            },

            // Card attributes
            'cost' => $this->faker->numberBetween(1, 10),
            'rarity' => $this->faker->randomElement($rarities),
            'image_url' => $this->faker->imageUrl(350, 450),
            'evolved_image_url' => $this->faker->boolean(70) ? $this->faker->imageUrl(350, 450) : null,

            // Follower stats - will be null for non-followers
            'attack' => $this->faker->boolean(60) ? $this->faker->numberBetween(1, 8) : null,
            'defense' => $this->faker->boolean(60) ? $this->faker->numberBetween(1, 8) : null,
            'evolved_attack' => $this->faker->boolean(60) ? $this->faker->numberBetween(3, 10) : null,
            'evolved_defense' => $this->faker->boolean(60) ? $this->faker->numberBetween(3, 10) : null,

            // Card metadata
            'is_token' => $this->faker->boolean(20),
            'is_basic' => $this->faker->boolean(10),
            'is_neutral' => $this->faker->boolean(30),
            'is_active' => true,
        ];
    }

    /**
     * Configure the factory to create a Follower card.
     */
    public function follower()
    {
        return $this->state(function (array $attributes) {
            return [
                'card_type_id' => function () {
                    return CardType::firstOrCreate(
                        ['name' => 'Follower'],
                        ['slug' => 'follower', 'is_active' => true]
                    )->id;
                },
                'attack' => $this->faker->numberBetween(1, 8),
                'defense' => $this->faker->numberBetween(1, 8),
                'evolved_attack' => $this->faker->numberBetween(3, 10),
                'evolved_defense' => $this->faker->numberBetween(3, 10),
            ];
        });
    }

    /**
     * Configure the factory to create a Spell card.
     */
    public function spell()
    {
        return $this->state(function (array $attributes) {
            return [
                'card_type_id' => function () {
                    return CardType::firstOrCreate(
                        ['name' => 'Spell'],
                        ['slug' => 'spell', 'is_active' => true]
                    )->id;
                },
                'attack' => null,
                'defense' => null,
                'evolved_attack' => null,
                'evolved_defense' => null,
                'evolved_effect' => null,
            ];
        });
    }
}
