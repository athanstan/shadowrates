<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Card;
use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasCardFilters;

class DeckBuilder extends Component
{
    use HasCardFilters;

    // Deck properties
    public $deckName = 'New Deck';
    public $mainDeck = [];
    public $evolutionDeck = [];
    public $leaderCardId = null;
    public $deckCraftId = null;
    protected $queryString = [];

    public function boot()
    {
        // Set up query string parameters from the trait
        $this->queryString = $this->getCardFilterQueryString();
    }

    public function mount($deck = null)
    {
        // Initialize empty deck arrays
        $this->mainDeck = [];
        $this->evolutionDeck = [];
        $this->leaderCardId = null;
        $this->deckCraftId = null;

        // If editing an existing deck
        if ($deck) {
            // Load deck data
            // This is just a placeholder, you'll implement the actual logic
        }

        // Initialize card filters
        $this->initializeCardFilters();
    }

    /**
     * Update the deck craft based on the leader card
     */
    public function updateDeckCraft($cardId)
    {
        $this->leaderCardId = $cardId;

        // Get the craft ID from the leader card
        $card = Card::find($cardId);
        if ($card) {
            $this->deckCraftId = $card->craft_id;
        }
    }

    /**
     * Clear the deck craft when leader is removed
     */
    public function clearDeckCraft()
    {
        $this->leaderCardId = null;
        $this->deckCraftId = null;
    }

    public function saveDeck()
    {
        // Validate deck name
        if (!$this->deckName) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Please provide a name for your deck'
            ]);
            return;
        }

        // Validate deck size
        $mainDeckCount = collect($this->mainDeck)->sum(function ($card) {
            return $card['quantity'];
        });

        if ($mainDeckCount < 40) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Your main deck must have at least 40 cards'
            ]);
            return;
        }

        if ($mainDeckCount > 50) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Your main deck cannot have more than 50 cards'
            ]);
            return;
        }

        // Validate leader card (required)
        if (!$this->leaderCardId) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Your deck must have a Leader card'
            ]);
            return;
        }

        // Create a new deck with the craft from the leader card
        $deck = Deck::create([
            'name' => $this->deckName,
            'user_id' => Auth::id(),
            'craft_id' => $this->deckCraftId,
        ]);

        // Add main deck cards
        foreach ($this->mainDeck as $cardId => $cardData) {
            $deck->cards()->attach($cardId, [
                'quantity' => $cardData['quantity'],
                'is_evolution' => false,
            ]);
        }

        // Add evolution cards
        foreach ($this->evolutionDeck as $cardId => $cardData) {
            $deck->cards()->attach($cardId, [
                'quantity' => $cardData['quantity'],
                'is_evolution' => true,
            ]);
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Deck saved successfully!'
        ]);

        // Redirect to the decks index
        return redirect()->route('decks.index');
    }

    #[Computed]
    public function cardsQuery(): Builder
    {
        $query = Card::query();

        // Apply the common filters from the trait
        return $this->applyCardFilters($query);
    }

    #[Layout('components.app-layout')]
    public function render()
    {
        return view('livewire.deck-builder', [
            'cards' => $this->cardsQuery()->paginate($this->perPage),
        ]);
    }
}
