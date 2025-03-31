<?php

namespace App\Livewire\Deck;

use App\Livewire\ActionComponent;
use App\Models\Deck;
use Livewire\Attributes\Layout;

class DeckProfile extends ActionComponent
{
    public Deck $deck;
    public $leaderCard = null;

    public function mount(Deck $deck)
    {
        $this->deck = $deck;
        $this->loadLeaderCard();
    }

    protected function loadLeaderCard()
    {
        // Find the leader card if exists
        $this->leaderCard = $this->deck->cards()
            ->where('main_type', 'leader')
            ->first();
    }

    public function authorizeAction(): void
    {
        // By default, allow all actions
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // Load deck with cards sorted by cost
        $this->deck->load(['cards' => function ($query) {
            $query->orderBy('cost');
        }]);

        return view('livewire.deck.deck-profile');
    }
}
