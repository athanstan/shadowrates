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
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DeckBuilder extends Component
{
    use HasCardFilters;

    // Deck properties
    public $deckName;
    public $deckDescription = '';
    public $mainDeck = [];
    public $evolutionDeck = [];
    public $leaderCardId = null;
    public $deckCraftId = null;
    protected $queryString = [];

    public Deck $deck;

    public function boot()
    {
        $this->queryString = $this->getCardFilterQueryString();
    }

    public function mount($deck = null)
    {
        // Initialize empty deck arrays

        // If editing an existing deck
        if ($deck === null) {
            $this->deck = Deck::make();

            $this->mainDeck = [];
            $this->evolutionDeck = [];
            $this->leaderCardId = null;
            $this->deckCraftId = null;
        } else {
            $this->deckName = $deck->name;
            $this->deckDescription = $deck->description;
            $this->mainDeck = $deck->cards->toArray();
        }

        // Initialize card filters
        $this->initializeCardFilters();
    }

    public function saveDeck()
    {
        // authorize the action
        // Validate Data
        $deckCards = collect($this->mainDeck)
            ->merge(collect($this->evolutionDeck))
            ->mapWithKeys(function ($item) {
                return [$item['id'] => ['quantity' => $item['quantity']]];
            });

        DB::transaction(function () use ($deckCards) {
            $this->deck = Deck::updateOrCreate(
                ['id' => $this->deck->id],
                [
                    'name' => $this->deckName,
                    'description' => $this->deckDescription,
                    'user_id' => Auth::id(),
                ]
            );

            $this->deck->cards()->sync($deckCards);
        });

        $this->dispatch('show-success', message: 'Deck saved successfully!');

        // Redirect to the decks index
        return redirect()->route('decks.edit', ['deck' => $this->deck->id]);
    }

    public function loadMore(): void
    {
        $this->perPage += 24;
    }

    #[Computed]
    public function cardsQuery(): Builder
    {
        $query = Card::query();

        return $this->applyCardFilters($query);
    }

    #[Layout('components.app-layout')]
    public function render(): View
    {
        return view('livewire.deck-builder', [
            'cards' => $this->cardsQuery()->paginate($this->perPage),
        ]);
    }
}
