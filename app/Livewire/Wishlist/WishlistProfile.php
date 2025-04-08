<?php

namespace App\Livewire\Wishlist;

use App\Models\Wishlist;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Enums\Craft;
use App\Enums\Rarity;
use Illuminate\Support\Collection;

class WishlistProfile extends Component
{
    public Wishlist $wishlist;
    public Collection $craftPercentages;
    public Collection $rarityPercentages;
    public Collection $craftCounts;
    public Collection $rarityCounts;

    public function mount($slug)
    {
        $this->wishlist = Wishlist::with([
            'cards' => function ($query) {
                $query->withBaseRelations()
                    ->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                    ->orderBy('name');
            },
            'user',
            'deck'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        // Check if wishlist is public or belongs to authenticated user
        if (
            !$this->wishlist->is_public &&
            (!Auth::check() || Auth::id() !== $this->wishlist->user_id)
        ) {
            abort(403, 'This wishlist is private');
        }

        // Calculate craft percentages
        $totalCards = $this->wishlist->cards->count();
        $this->craftCounts = $this->wishlist->cards->groupBy('craft.slug')->map->count();
        $this->craftPercentages = $totalCards > 0
            ? $this->craftCounts->map(fn($count) => round(($count / $totalCards) * 100, 1))
            : collect();

        // Calculate rarity percentages
        $this->rarityCounts = $this->wishlist->cards->groupBy('rarity')->map->count();
        $this->rarityPercentages = $totalCards > 0
            ? $this->rarityCounts->map(fn($count) => round(($count / $totalCards) * 100, 1))
            : collect();
    }

    /**
     * Get the background class for a craft
     */
    public function getCraftBackground(string $craftSlug): string
    {
        $craftEnum = Craft::tryFrom($craftSlug);
        return $craftEnum ? $craftEnum->background() : 'bg-gray-700';
    }

    /**
     * Get the background class for a rarity
     */
    public function getRarityBackground(string $rarityName): string
    {
        $rarityEnum = Rarity::tryFrom($rarityName);
        return $rarityEnum ? $rarityEnum->background() : 'bg-gray-700';
    }

    /**
     * Get the display name for a craft
     */
    public function getCraftName(string $craftSlug): string
    {
        $craftEnum = Craft::tryFrom($craftSlug);
        return $craftEnum ? $craftEnum->name() : ucfirst($craftSlug);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wishlist.wishlist-profile');
    }
}
