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
        return [
            'name' => $this->faker->words(3, true) . ' Deck',
            'description' => $this->faker->text(),
            'user_id' => User::factory(),
            'is_public' => $this->faker->boolean(70), // 70% chance of being public
            'format' => $this->faker->randomElement([1, 2]), // 1 = Rotation, 2 = Unlimited
        ];
    }
}
