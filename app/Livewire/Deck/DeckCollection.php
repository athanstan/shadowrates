<?php

namespace App\Livewire\Deck;

use App\Livewire\ActionComponent;
use App\Models\Deck;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class DeckCollection extends ActionComponent
{
    use WithPagination;

    public function authorizeAction(): void
    {
        // By default, allow all actions
    }

    #[Computed()]
    public function decks(): LengthAwarePaginator
    {
        return Deck::query()
            ->where('is_public', true)
            ->withLeader()
            ->with([
                'user',
                'cards' => fn($q) => $q->with([
                    'craft:id,name'
                ])
                    ->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                    ->orderBy('name'),
                'craft'
            ])
            ->withCount('cards')
            ->latest()
            ->paginate(9);
    }

    #[Computed()]
    public function decksByUser(): Collection
    {
        return $this->decks->groupBy('user.name');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.deck.deck-collection', [
            'decks' => $this->decks,
            'decksByUser' => $this->decksByUser
        ]);
    }
}
