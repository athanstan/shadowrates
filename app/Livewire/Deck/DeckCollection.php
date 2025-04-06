<?php

namespace App\Livewire\Deck;

use App\Livewire\ActionComponent;
use App\Models\Deck;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

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
            ->latest()
            ->paginate(9);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.deck.deck-collection', [
            'decks' => $this->decks
        ]);
    }
}
