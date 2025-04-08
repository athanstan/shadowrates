<?php

namespace App\Livewire\User;

use App\Enums\Craft as EnumsCraft;
use App\Models\Card;
use App\Models\Craft;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

class UserProfile extends Component
{
    public User $user;

    public function mount($slug)
    {
        // dd($this->craftCounts());
        $this->user = User::with([
            'decks' => function ($query) {
                $query->orderBy('decks.created_at', 'desc')
                    ->withCount('cards')
                    ->withSum('cards as cards_count', 'deck_cards.quantity')
                    ->withLeader()
                    ->with([
                        'cards' => fn($q) => $q->with([
                            'craft:id,name'
                        ])
                            ->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                            ->orderBy('name'),
                    ]);
            },
            'cards' => function ($query) {
                $query
                    ->with([
                        'cardType:id,name',
                        'craft:id,name',
                        'cardSet:id,name',
                    ])
                    ->orderBy('cards.created_at', 'desc')->take(18);
            }
        ])
            ->withCount(['decks', 'wishlists', 'cards'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Computed]
    public function collectionPercentage(): int
    {
        $totalCards = Card::count();

        return $totalCards > 0 ? round(($this->user->cards_count / $totalCards) * 100, 1) : 0;
    }

    #[Computed]
    public function craftCounts(): array
    {
        $crafts = $this->crafts();
        $userId = $this->user->id;
        // Base query for total cards
        $query = Card::selectRaw('COUNT(DISTINCT cards.id) as total_cards')
            ->join('card_user', function ($join) use ($userId) {
                $join->on('cards.id', '=', 'card_user.card_id')
                    ->where('card_user.user_id', '=', $userId);
            });

        // Add a count column for each craft
        foreach ($crafts as $craft) {
            $safeColumnName = Str::snake($craft->slug) . '_count';
            // Count will now be filtered by the join condition
            $query->selectRaw(
                "COUNT(DISTINCT CASE WHEN cards.craft_id = ? THEN cards.id END) as \"$safeColumnName\"",
                [$craft->id]
            );

            // Percentage calculation will use the filtered total
            $query->selectRaw(
                "ROUND(COUNT(DISTINCT CASE WHEN cards.craft_id = ? THEN cards.id END) * 100.0 /
            NULLIF(COUNT(DISTINCT cards.id), 0), 2) as \"" .
                    Str::snake($craft->slug) . "_percentage\"",
                [$craft->id]
            );
        }

        $result = $query->first();
        return $result ? $result->toArray() : ['total_cards' => 0];
    }

    #[Computed]
    public function crafts(): Collection
    {
        return Craft::get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-profile');
    }

    public function getCraftBackground(string $craftSlug): string
    {
        $craftEnum = EnumsCraft::tryFrom($craftSlug);
        return $craftEnum ? $craftEnum->background() : 'bg-gray-700';
    }
}
