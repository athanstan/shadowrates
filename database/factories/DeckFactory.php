<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deck>
 */
class DeckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classes = ['Forestcraft', 'Swordcraft', 'Runecraft', 'Dragoncraft', 'Shadowcraft', 'Bloodcraft', 'Havencraft', 'Portalcraft'];

        return [
            'name' => $this->faker->words(3, true) . ' Deck',
            'description' => $this->faker->boolean(80) ? $this->faker->paragraph() : null,
            'user_id' => User::factory(),
            'class' => $this->faker->randomElement($classes),
            'is_public' => $this->faker->boolean(70), // 70% chance of being public
        ];
    }
}
