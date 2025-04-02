<?php

namespace App\Livewire\Deck;

use App\Livewire\ActionComponent;
use App\Models\Deck;
use Livewire\Attributes\Layout;

class DeckProfile extends ActionComponent
{
    public Deck $deck;
    public $leaderCard = null;

    public function authorizeAction(): void
    {
        //
    }

    public function mount(string $slug)
    {
        $this->deck = Deck::query()
            ->where('slug', $slug)
            ->with([
                'cards' => fn($q) => $q->orderBy('cost'),
                'cards.cardType',
                'cards.cardSet',
                'cards.craft',
            ])
            ->firstOrFail();
        $this->leaderCard = $this->deck->getLeaderCard();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.deck.deck-profile');
    }
}
