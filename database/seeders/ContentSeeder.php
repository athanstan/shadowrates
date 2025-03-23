<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->log('Reading db.json file...');

        // Read the JSON file
        $jsonPath = resource_path('assets/db.json');
        if (!File::exists($jsonPath)) {
            $this->logError("File not found: {$jsonPath}");
            return;
        }

        $jsonData = json_decode(File::get($jsonPath), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logError('Invalid JSON file: ' . json_last_error_msg());
            return;
        }

        $this->log('JSON file successfully loaded.');

        // Seed card sets (expansions)
        if (isset($jsonData['filters']['expansions'])) {
            $this->seedCardSets($jsonData['filters']['expansions']);
        }

        // Seed crafts (clans)
        if (isset($jsonData['filters']['clans'])) {
            $this->seedCrafts($jsonData['filters']['clans']);
        }

        // Seed card types if they exist in the JSON
        $this->seedCardTypes();

        // Seed cards if they exist in the JSON
        if (isset($jsonData['cards'])) {
            $this->seedCards($jsonData['cards']);
        }

        $this->log('Content seeding completed successfully!');
    }

    /**
     * Helper method to handle logging in both console and test environments
     */
    private function log(string $message): void
    {
        if ($this->command instanceof Command) {
            $this->command->info($message);
        } else {
            Log::info($message);
        }
    }

    /**
     * Helper method to handle error logging in both console and test environments
     */
    private function logError(string $message): void
    {
        if ($this->command instanceof Command) {
            $this->command->error($message);
        } else {
            Log::error($message);
        }
    }

    /**
     * Seed card sets from expansion data
     */
    private function seedCardSets(array $expansions): void
    {
        $this->log('Seeding card sets...');
        $count = 0;

        foreach ($expansions as $index => $expansion) {
            // Map the JSON structure to our model fields
            $cardSet = CardSet::firstOrCreate(
                ['short_name' => $expansion['id']],
                [
                    'name' => $expansion['name'],
                    'slug' => Str::slug($expansion['name']),
                    'description' => "Card set from {$expansion['name']}",
                    'logo_url' => null, // Could be set if available in JSON
                    'release_date' => now()->subMonths($index), // Approximate based on order
                    'is_standard_legal' => $expansion['set_type'] === 1, // Assuming booster sets are standard legal
                    'is_active' => true,
                    'display_order' => $index + 1,
                ]
            );

            $count++;
        }

        $this->log("Seeded {$count} card sets.");
    }

    /**
     * Seed crafts from clan data
     */
    private function seedCrafts(array $clans): void
    {
        $this->log('Seeding crafts...');
        $count = 0;

        // Define color mapping for crafts
        $colorMap = [
            'forestcraft' => '#4CAF50',
            'swordcraft' => '#FFC107',
            'runecraft' => '#2196F3',
            'dragoncraft' => '#FF5722',
            'abysscraft' => '#9C27B0', // Similar to Shadowcraft
            'havencraft' => '#FFEB3B',
            'neutral' => '#607D8B',
            'umamusume' => '#E91E63',
            'idolmaster_cinderella' => '#00BCD4',
            'cf_vanguard' => '#8BC34A',
        ];

        foreach ($clans as $index => $clan) {
            // Map the JSON structure to our model fields
            $craft = Craft::firstOrCreate(
                ['name' => $clan['name']],
                [
                    'slug' => $clan['normalized_name'],
                    'description' => "{$clan['name']} craft from Shadowverse",
                    'icon_url' => null, // Could be set if available in JSON
                    'color_code' => $colorMap[$clan['normalized_name']] ?? '#666666',
                    'banner_url' => null, // Could be set if available in JSON
                    'is_active' => true,
                    'display_order' => $index + 1,
                ]
            );

            $count++;
        }

        $this->log("Seeded {$count} crafts.");
    }

    /**
     * Seed card types
     */
    private function seedCardTypes(): void
    {
        $this->log('Seeding card types...');

        $cardTypes = [
            [
                'name' => 'Follower',
                'slug' => 'follower',
                'description' => 'A card that can attack and defend',
                'icon_url' => null,
                'is_active' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Spell',
                'slug' => 'spell',
                'description' => 'A card that has an effect when played',
                'icon_url' => null,
                'is_active' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Amulet',
                'slug' => 'amulet',
                'description' => 'A card with persistent effects',
                'icon_url' => null,
                'is_active' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Leader',
                'slug' => 'leader',
                'description' => 'A special card that represents the deck leader',
                'icon_url' => null,
                'is_active' => true,
                'display_order' => 4,
            ],
        ];

        $count = 0;
        foreach ($cardTypes as $type) {
            CardType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );

            $count++;
        }

        $this->log("Seeded {$count} card types.");
    }

    /**
     * Seed cards
     */
    private function seedCards(array $cards): void
    {
        $this->log('Seeding cards...');
        $count = 0;
        $batchSize = 100;
        $totalCards = count($cards);

        // Get all crafts, card types and card sets for lookups
        $crafts = Craft::all()->keyBy('name');
        $fallbackCraft = Craft::first();

        $cardTypes = CardType::all()->keyBy('name');
        $fallbackCardType = CardType::first();

        $cardSets = CardSet::all()->keyBy('short_name');
        $fallbackCardSet = CardSet::first();

        // Process in batches to avoid memory issues
        foreach (array_chunk($cards, $batchSize) as $cardBatch) {
            foreach ($cardBatch as $cardData) {
                // Extract card data based on JSON structure
                // This is an example and might need adjustment based on actual JSON structure

                // Skip if card doesn't have essential data
                if (!isset($cardData['name'])) {
                    continue;
                }

                // Map card type
                $cardTypeName = isset($cardData['card_type']) ? $this->mapCardType($cardData['card_type']) : 'Follower';
                $cardTypeId = $cardTypes->get($cardTypeName, $fallbackCardType)->id;

                // Map craft
                $craftName = $cardData['clan_name'] ?? null;
                $craftId = $craftName ? ($crafts->get($craftName, $fallbackCraft)->id) : $fallbackCraft->id;

                // Map card set
                $cardSetId = null;
                if (isset($cardData['card_set_id'])) {
                    $cardSetId = $cardSets->get($cardData['card_set_id'], $fallbackCardSet)->id;
                } else {
                    $cardSetId = $fallbackCardSet->id;
                }

                // Create or update the card
                Card::firstOrCreate(
                    ['name' => $cardData['name']],
                    [
                        'original_card_id' => $cardData['id'] ?? null,
                        'description' => $cardData['description'] ?? $cardData['flavor_text'] ?? 'No description available',
                        'effect' => $cardData['effects'] ?? 'No effect available',
                        'evolved_effect' => $cardData['evolved_effect_text'] ?? null,
                        'card_type_id' => $cardTypeId,
                        'craft_id' => $craftId,
                        'card_set_id' => $cardSetId,
                        'cost' => $cardData['cost'] ?? 0,
                        'rarity' => $this->mapRarity($cardData['rarity'] ?? 'bronze'),
                        'image' => $cardData['id'] . '.jpg',
                        'evolved_image' => $cardData['evolved_image'] ?? null,
                        'attack' => $cardData['attack'] ?? null,
                        'defense' => $cardData['defense'] ?? null,
                        'evolved_attack' => $cardData['evolved_attack'] ?? null,
                        'evolved_defense' => $cardData['evolved_defense'] ?? null,
                        'is_token' => $cardData['is_token'] ?? false,
                        'is_basic' => $cardData['is_basic'] ?? false,
                        'is_neutral' => $craftName === 'Neutral',
                        'is_active' => true,
                    ]
                );

                $count++;

                // Show progress
                if ($count % 100 === 0 || $count === $totalCards) {
                    $this->log("Seeded {$count}/{$totalCards} cards...");
                }
            }
        }

        $this->log("Completed seeding {$count} cards.");
    }

    /**
     * Map card type from JSON to our system
     */
    private function mapCardType(string $type): string
    {
        $typeMap = [
            'follower' => 'Follower',
            'spell' => 'Spell',
            'amulet' => 'Amulet',
            'leader' => 'Leader',
        ];

        return $typeMap[strtolower($type)] ?? 'Follower';
    }

    /**
     * Map rarity from JSON to our system
     */
    private function mapRarity(string $rarity): string
    {
        $rarityMap = [
            'bronze' => 'Bronze',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'legendary' => 'Legendary',
        ];

        return $rarityMap[strtolower($rarity)] ?? 'Bronze';
    }
}
