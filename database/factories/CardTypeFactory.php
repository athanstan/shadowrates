<?php

namespace Database\Factories;

use App\Models\CardType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardType>
 */
class CardTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(['Follower', 'Spell', 'Amulet', 'Leader']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(100),
            'icon_url' => $this->faker->imageUrl(50, 50),
            'is_active' => true,
            'display_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
