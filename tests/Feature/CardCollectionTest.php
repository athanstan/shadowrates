<?php

use App\Livewire\CardCollection;
use App\Models\Card;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use function Pest\Livewire\livewire;

test('card collection page loads successfully', function () {
    $this->get(route('cards.index'))
        ->assertStatus(200);
});

test('card collection component can be rendered', function () {
    livewire(CardCollection::class)
        ->assertOk();
});

test('card collection filters work correctly', function () {
    // Create test dependencies
    $cardType = CardType::factory()->create(['name' => 'Follower']);
    $craft = Craft::factory()->create(['name' => 'Forestcraft']);
    $cardSet = CardSet::factory()->create(['name' => 'Classic']);

    // Create test cards
    $matchingCard = Card::factory()->create([
        'name' => 'Forest Champion',
        'card_type_id' => $cardType->id,
        'craft_id' => $craft->id,
        'card_set_id' => $cardSet->id,
        'cost' => 5,
        'rarity' => 'Gold'
    ]);

    $nonMatchingCard = Card::factory()->create([
        'name' => 'Shadow Reaper',
        'cost' => 7,
        'rarity' => 'Legendary'
    ]);

    // Test search filter
    livewire(CardCollection::class)
        ->set('search', 'Forest')
        ->assertSee('Forest Champion')
        ->assertDontSee('Shadow Reaper');

    // Test craft filter
    livewire(CardCollection::class)
        ->set('selectedCraft', $craft->id)
        ->assertSee('Forest Champion')
        ->assertDontSee('Shadow Reaper');

    // Test cost filter
    livewire(CardCollection::class)
        ->set('costFilter', '5')
        ->assertSee('Forest Champion')
        ->assertDontSee('Shadow Reaper');

    // Test multiple filters
    livewire(CardCollection::class)
        ->set('selectedCardType', $cardType->id)
        ->set('rarityFilter', 'Gold')
        ->assertSee('Forest Champion')
        ->assertDontSee('Shadow Reaper');
});

test('card collection sorting works correctly', function () {
    // Create test cards with specific ordering
    Card::factory()->create(['name' => 'B Card', 'cost' => 5, 'created_at' => now()->subDay()]);
    Card::factory()->create(['name' => 'A Card', 'cost' => 8, 'created_at' => now()]);
    Card::factory()->create(['name' => 'C Card', 'cost' => 2, 'created_at' => now()->subDays(2)]);

    // Test name sorting (default)
    livewire(CardCollection::class)
        ->call('sortBy', 'name')
        ->assertSeeInOrder(['A Card', 'B Card', 'C Card']);

    // Test cost sorting
    livewire(CardCollection::class)
        ->call('sortBy', 'cost')
        ->assertSeeInOrder(['C Card', 'B Card', 'A Card']);

    // Test created_at sorting
    livewire(CardCollection::class)
        ->call('sortBy', 'created_at')
        ->assertSeeInOrder(['C Card', 'B Card', 'A Card']);

    // Test direction toggle
    livewire(CardCollection::class)
        ->call('sortBy', 'name')
        ->call('sortBy', 'name') // Toggle to desc
        ->assertSeeInOrder(['C Card', 'B Card', 'A Card']);
});

test('reset filters button works correctly', function () {
    // Setup component with filters
    $component = livewire(CardCollection::class)
        ->set('search', 'test')
        ->set('selectedCardType', '1')
        ->set('selectedCraft', '2')
        ->set('selectedCardSet', '3')
        ->set('costFilter', '4')
        ->set('rarityFilter', 'Gold');

    // Reset filters
    $component->call('resetFilters');

    // Assert filters are reset
    $component
        ->assertSet('search', '')
        ->assertSet('selectedCardType', '')
        ->assertSet('selectedCraft', '')
        ->assertSet('selectedCardSet', '')
        ->assertSet('costFilter', '')
        ->assertSet('rarityFilter', '');
});
