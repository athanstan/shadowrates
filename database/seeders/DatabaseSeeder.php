<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create more users
        User::factory(5)->create();

        // Call seeders in the correct order
        $this->call([
            ContentSeeder::class, // First seed content from db.json
            DeckSeeder::class,    // Then decks (which use cards)
            RatingSeeder::class,  // Then ratings (which use cards and decks)
            SocialLinkSeeder::class, // Add social links
        ]);
    }
}
