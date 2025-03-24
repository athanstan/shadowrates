<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Card;
use App\Enums\CardSubType;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class DeckBuilder extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $selectedCardType = '';
    public $selectedCardSubType = '';
    public $selectedCraft = '';
    public $selectedCardSet = '';
    public $costFilter = '';
    public $rarityFilter = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 24;

    // Deck properties
    public $deckName = 'New Deck';
    public $mainDeck = [];
    public $evolutionDeck = [];

    public $cardTypes = [];
    public $cardSubTypes = [];
    public $crafts = [];
    public $cardSets = [];
    public $rarities = ['Bronze', 'Silver', 'Gold', 'Legendary'];
    public $costs = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9+'];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCardType' => ['except' => ''],
        'selectedCardSubType' => ['except' => ''],
        'selectedCraft' => ['except' => ''],
        'selectedCardSet' => ['except' => ''],
        'costFilter' => ['except' => ''],
        'rarityFilter' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 24],
    ];

    public function resetFilters()
    {
        $this->reset([
            'search',
            'selectedCardType',
            'selectedCardSubType',
            'selectedCraft',
            'selectedCardSet',
            'costFilter',
            'rarityFilter',
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
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

        // Get all the necessary data for filters
        $this->cardTypes = CardType::pluck('name', 'id')->toArray();
        $this->cardSubTypes = CardSubType::cases();
        $this->crafts = Craft::pluck('name', 'id')->toArray();
        $this->cardSets = CardSet::pluck('name', 'id')->toArray();
        $this->costs = range(0, 10);
        $this->rarities = ['Bronze', 'Silver', 'Gold', 'Legendary'];
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

    #[Layout('components.app-layout')]
    public function render()
    {
        $cards = Card::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('effects', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCardType, function ($query) {
                return $query->whereHas('cardType', function ($subQuery) {
                    $subQuery->where('id', $this->selectedCardType);
                });
            })
            ->when($this->selectedCardSubType, function ($query) {
                return $query->where('sub_type', $this->selectedCardSubType);
            })
            ->when($this->selectedCraft, function ($query) {
                return $query->where('craft_id', $this->selectedCraft);
            })
            ->when($this->selectedCardSet, function ($query) {
                return $query->where('card_set_id', $this->selectedCardSet);
            })
            ->when($this->costFilter, function ($query) {
                return $query->where('cost', $this->costFilter);
            })
            ->when($this->rarityFilter, function ($query) {
                return $query->where('rarity', $this->rarityFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.deck-builder', [
            'cards' => $cards,
        ]);
    }
}
