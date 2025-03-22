<?php

namespace Database\Factories;

use App\Models\Craft;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Craft>
 */
class CraftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(['Forestcraft', 'Swordcraft', 'Runecraft', 'Dragoncraft', 'Shadowcraft', 'Bloodcraft', 'Havencraft', 'Portalcraft']);
        $colorMap = [
            'Forestcraft' => '#4CAF50',
            'Swordcraft' => '#FFC107',
            'Runecraft' => '#2196F3',
            'Dragoncraft' => '#FF5722',
            'Shadowcraft' => '#9C27B0',
            'Bloodcraft' => '#F44336',
            'Havencraft' => '#FFEB3B',
            'Portalcraft' => '#607D8B',
        ];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(),
            'icon_url' => $this->faker->imageUrl(50, 50),
            'color_code' => $colorMap[$name] ?? '#666666',
            'banner_url' => $this->faker->imageUrl(1200, 300),
            'is_active' => true,
            'display_order' => $this->faker->numberBetween(1, 8),
        ];
    }
}
