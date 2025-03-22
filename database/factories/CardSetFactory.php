<?php

namespace Database\Factories;

use App\Models\CardSet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardSet>
 */
class CardSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $setNames = [
            'Classic',
            'Darkness Evolved',
            'Rise of Bahamut',
            'Tempest of the Gods',
            'Wonderland Dreams',
            'Starforged Legends',
            'Chronogenesis',
            'Dawnbreak Nightedge',
            'Brigade of the Sky',
            'Omen of the Ten',
            'Altersphere',
            'Steel Rebellion'
        ];

        $name = $this->faker->unique()->randomElement($setNames);
        $shortName = preg_replace('/[a-z\s]+/i', '', $name);
        if (empty($shortName)) {
            $shortName = substr($name, 0, 3);
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'short_name' => $shortName,
            'description' => $this->faker->text(150),
            'logo_url' => $this->faker->imageUrl(200, 100),
            'release_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'is_standard_legal' => $this->faker->boolean(70),
            'is_active' => true,
            'display_order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
