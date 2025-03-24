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

        // If editing an existing deck
        if ($deck) {
            // Load deck data
            // This is just a placeholder, you'll implement the actual logic
        }

        // Initialize card filters
        $this->initializeCardFilters();
    }

    public function saveDeck()
    {
        // Data has already been validated on the client side
        // Create a new deck
        $deckCraftId = null;

        // Get craft ID from the first card if available
        if (!empty($this->mainDeck)) {
            $firstCardId = array_key_first($this->mainDeck);
            if ($firstCardId) {
                $firstCard = Card::find($firstCardId);
                if ($firstCard) {
                    $deckCraftId = $firstCard->craft_id;
                }
            }
        }

        $deck = Deck::create([
            'name' => $this->deckName,
            'user_id' => Auth::id(),
            'craft_id' => $deckCraftId,
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
