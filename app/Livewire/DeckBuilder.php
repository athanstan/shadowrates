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
    public $isPublic = false;
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
            $this->deck = new Deck();
            $this->deckName = 'New Deck';
            $this->mainDeck = [];
            $this->evolutionDeck = [];
            $this->leaderCardId = null;
            $this->deckCraftId = null;
        } else {
            $this->deckName = $deck->name;
            $this->deckDescription = $deck->description;
            $this->isPublic = $deck->is_public;
            foreach ($deck->cards as $card) {
                $values = [
                    "id" => $card->id,
                    "name" => $card->name,
                    "cost" => $card->cost,
                    "rarity" => $card->rarity,
                    "card_type" => $card->card_type,
                    "sub_type" => $card->sub_type,
                    "quantity" => $card->pivot->quantity,
                    "image" => $card->getImage(),
                ];

                if ($card->sub_type === 'evolved') {
                    $this->evolutionDeck[$card->id] = $values;  // Use card ID as key
                } else {
                    $this->mainDeck[$card->id] = $values;  // Use card ID as key
                }
            }
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

        return $this->redirect(
            route('decks.edit', ['deck' => $this->deck->id]),
            navigate: true
        );
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
