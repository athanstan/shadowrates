<?php

namespace App\Livewire\Deck;

use App\Livewire\ActionComponent;
use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class DeckCollection extends ActionComponent
{
    use WithPagination;

    public function authorizeAction(): void
    {
        // By default, allow all actions
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $decks = Auth::check()
            ? Auth::user()->decks()->latest()->paginate(9)
            : Deck::where('is_public', true)->latest()->paginate(9);

        return view('livewire.deck.deck-collection', [
            'decks' => $decks
        ]);
    }
}
