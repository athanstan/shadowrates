<?php

namespace App\Console\Commands;

use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use App\Models\Card; // Ensure Card model is imported
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchContentFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Content from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.svemaster.com/cards/?limit=9999');

        $data = $response->json();

        if (isset($data['filters']['expansions'])) {
            $this->seedCardSets($data['filters']['expansions']);
        }

        if (isset($data['filters']['clans'])) {
            $this->seedCrafts($data['filters']['clans']);
        }

        $this->seedCardTypes();

        if (isset($data['cards'])) {
            $this->seedCards($data['cards']);
        }
    }

    private function seedCardSets(array $expansions): void
    {
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
            $this->info("Seeded Card Set: {$cardSet->name}");
        }
    }

    private function seedCrafts(array $clans): void
    {
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
            $this->info("Seeded Craft: {$craft->name}");
        }
    }

    /**
     * Seed card types
     */
    private function seedCardTypes(): void
    {
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
            $this->info("Seeded Card Type: {$type['name']}");
        }
    }

    /**
     * Seed cards
     */
    private function seedCards(array $cards): void
    {
        $this->info("Seeding Cards...");

        $count = 0;
        $batchSize = 100;
        $totalCards = count($cards);
        $uniqueCards = 0;

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
                // Skip if card doesn't have essential data
                if (!isset($cardData['name'])) {
                    $this->warn("Skipped card due to missing name.");
                    continue;
                }

                $this->downloadCardImage($cardData['id']);

                // Map card type from main_type
                $cardTypeName = isset($cardData['main_type']) ? $this->mapCardType($cardData['main_type']) : 'Follower';
                $cardTypeId = $cardTypes->get($cardTypeName, $fallbackCardType)->id;

                // Map craft from clan_name
                $craftName = $cardData['clan_name'] ?? null;
                $craftId = $craftName ? ($crafts->get($craftName, $fallbackCraft)->id) : $fallbackCraft->id;

                // Map card set from expansion_id
                $cardSetId = null;
                if (isset($cardData['expansion_id'])) {
                    $cardSetId = $cardSets->get($cardData['expansion_id'], $fallbackCardSet)->id;
                } else {
                    $cardSetId = $fallbackCardSet->id;
                }

                // Create or update the card
                try {
                    // If we have an original_card_id, use that as the primary unique key
                    if (isset($cardData['id']) && !empty($cardData['id'])) {
                        $uniqueKey['original_card_id'] = $cardData['id'];
                    } else {
                        // Otherwise use the composite key
                        $uniqueKey = [
                            'name' => $cardData['name'],
                            'sub_type' => $cardData['sub_type'] ?? null,
                            'rarity' => $this->mapRarity($cardData['rarity'] ?? 'bronze'),
                            'card_set_id' => $cardSetId
                        ];
                    }

                    // Generate a unique slug
                    $cardSetShortName = $cardData['expansion_id'] ?? 'unknown';
                    $rarityShort = strtolower(substr($this->mapRarity($cardData['rarity'] ?? 'bronze'), 0, 3));
                    // Add a unique identifier to make the slug truly unique
                    $uniqueIdentifier = isset($cardData['id']) ? substr(md5($cardData['id']), 0, 8) : substr(md5(uniqid()), 0, 8);
                    $uniqueSlug = Str::slug($cardData['name'] . '-' . ($cardData['sub_type'] ?? '') . '-' . $cardSetShortName . '-' . $rarityShort . '-' . $uniqueIdentifier);

                    $card = Card::firstOrCreate(
                        $uniqueKey, // Use original_card_id if available, otherwise composite key
                        [
                            'name' => $cardData['name'],
                            'slug' => $uniqueSlug,
                            'original_card_id' => $cardData['id'] ?? null,
                            'main_type' => $cardData['main_type'] ?? 'follower',
                            'sub_type' => $cardData['sub_type'] ?? null,
                            'description' => $cardData['description'] ?? $cardData['flavor_text'] ?? 'No description available',
                            'effects' => $cardData['effects'] ?? 'No effect available',
                            'traits' => $cardData['traits'] ?? null,
                            'language' => $cardData['language'] ?? 'en',
                            'card_type_id' => $cardTypeId,
                            'craft_id' => $craftId,
                            'card_set_id' => $cardSetId,
                            'cost' => $cardData['cost'] ?? 0,
                            'rarity' => $this->mapRarity($cardData['rarity'] ?? 'bronze'),
                            'image' => $cardData['id'] . '.jpg',
                            'evolved_image' => $cardData['sub_type'] === 'evolved' ? $cardData['id'] . '.jpg' : null,
                            'atk' => $cardData['atk'] ?? null, // Changed from attack to atk
                            'health' => $cardData['health'] ?? null, // Changed from defense to health
                            'evolved_atk' => $cardData['sub_type'] === 'evolved' ? $cardData['atk'] ?? null : null,
                            'evolved_health' => $cardData['sub_type'] === 'evolved' ? $cardData['health'] ?? null : null,
                            'is_token' => $cardData['is_token'] ?? false,
                            'is_basic' => $cardData['is_basic'] ?? false,
                            'is_neutral' => $craftName === 'Neutral',
                            'is_active' => true,
                        ]
                    );

                    // Check if this was a newly created card
                    if ($card->wasRecentlyCreated) {
                        $uniqueCards++;
                        $this->info("Seeded Card: {$card->name}");
                    }
                } catch (\Exception $e) {
                    $this->error("Error seeding card {$cardData['name']}: " . $e->getMessage());
                    continue;
                }

                $count++;

                // Show progress
                if ($count % 100 === 0 || $count === $totalCards) {
                    $this->info("Processed {$count}/{$totalCards} cards... (Unique: {$uniqueCards})");
                }
            }
        }
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

    /**
     * Download and save card image
     *
     * @param string $cardId The ID of the card
     * @return bool Success status
     */
    private function downloadCardImage($cardId)
    {
        try {
            $imageUrl = "https://cdn.young-cat.com/evolve/cards/{$cardId}.png";
            $imagePath = storage_path("app/card-images/{$cardId}.jpg");

            // Skip if image already exists
            if (File::exists($imagePath)) {
                $this->line("  <fg=yellow>Image for card {$cardId} already exists, skipping download</>");
                return true;
            }

            $this->line("  <fg=blue>Downloading image for card {$cardId}...</>");

            // Use Guzzle client to download the image
            $client = new \GuzzleHttp\Client();
            $response = $client->get($imageUrl, ['timeout' => 30]);

            if ($response->getStatusCode() === 200) {
                File::put($imagePath, $response->getBody());
                $this->line("  <fg=green>Image for card {$cardId} downloaded successfully</>");
                return true;
            } else {
                $this->line("  <fg=red>Failed to download image for card {$cardId}: HTTP status {$response->getStatusCode()}</>");
                return false;
            }
        } catch (\Exception $e) {
            $this->line("  <fg=red>Error downloading image for card {$cardId}: {$e->getMessage()}</>");
            return false;
        }
    }
}
