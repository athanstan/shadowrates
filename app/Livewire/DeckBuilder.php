<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Card;
use App\Models\Deck;
use App\Models\Wishlist;
use App\Rules\Deck\LeaderRule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasCardFilters;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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

    public function rules(): array
    {
        return [
            'deckName' => 'required|string|max:255',
            'deckDescription' => 'nullable|string|max:1000',
            'isPublic' => 'required|boolean',
            'mainDeck' => [
                'required',
                'array',
                'max:50',
                'min:1',
                new LeaderRule(),
            ],
            'mainDeck.*.id' => 'required|exists:cards,id',
            'mainDeck.*.quantity' => [
                'required',
                'integer',
                'min:1',
                'max:3',
            ],
            'evolutionDeck' => [
                'required',
                'array',
                'max:10',
                'min:1',
            ],
            'evolutionDeck.*.id' => 'required|exists:cards,id',
            'evolutionDeck.*.quantity' => [
                'required',
                'integer',
                'min:1',
                'max:3',
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'mainDeck.*.quantity.max' => 'You can only have 3 of each card in your main deck.',
            'evolutionDeck.*.quantity.max' => 'You can only have 3 of each card in your evolution deck.',
        ];
    }

    public function mount($deck = null)
    {
        if ($deck === null) {
            $this->deck = new Deck();
            $this->deckName = 'New Deck';
            $this->mainDeck = [];
            $this->evolutionDeck = [];
            $this->leaderCardId = null;
            $this->deckCraftId = null;
        } else {
            Gate::authorize('update', $deck);

            $this->deckName = $deck->name;
            $this->deckDescription = $deck->description;
            $this->isPublic = $deck->is_public;

            $cards = $deck
                ->cards()
                ->with('cardType')
                ->with('collections', fn($query) => $query->where('user_id', Auth::id()))
                ->get();

            foreach ($cards as $card) {
                $values = [
                    "id" => $card->id,
                    "name" => $card->name,
                    "cost" => $card->cost,
                    "rarity" => $card->rarity,
                    "card_type" => $card->cardType->name,
                    "sub_type" => $card->sub_type,
                    "quantity" => $card->pivot->quantity,
                    "owned" => $card->collections->first()?->quantity ?? 0,
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
        if ($this->deck->id) {
            Gate::authorize('update', $this->deck);
        }

        // Validate Data
        $this->validate();

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
                    'is_public' => $this->isPublic,
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

    public function saveCardsToWishlist($wishlistTitle): void
    {
        // Validate title
        if (empty($wishlistTitle)) {
            $this->dispatch('show-error', message: 'Please provide a title for your wishlist');
            return;
        }

        // Check if there are cards in the deck
        if (empty($this->mainDeck) && empty($this->evolutionDeck)) {
            $this->dispatch('show-error', message: 'No cards to add to wishlist');
            return;
        }

        // DB transaction
        DB::transaction(function () use ($wishlistTitle) {
            // Find or create a wishlist for the user
            $wishlist = Wishlist::firstOrCreate(
                [
                    'title' => $wishlistTitle,
                    'user_id' => Auth::id(),
                    'deck_id' => $this->deck->id ?? null,
                ],
                [
                    'is_public' => false, // Default to private
                ]
            );

            // Prepare cards from both decks
            $wishlistCards = [];
            foreach ($this->mainDeck as $card) {
                $quantity = $card['quantity'] - $card['owned'];
                if ($quantity > 0) {
                    $wishlistCards[$card['id']] = ['quantity' => $quantity];
                }
            }

            foreach ($this->evolutionDeck as $card) {
                $quantity = $card['quantity'] - $card['owned'];
                if ($quantity > 0) {
                    $wishlistCards[$card['id']] = ['quantity' => $quantity];
                }
            }

            // Sync the cards to the wishlist (this will overwrite existing cards)
            $wishlist->cards()->sync($wishlistCards);
        });

        // dispatch a success message
        $this->dispatch('show-success', message: 'Cards saved to wishlist!');
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

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.deck-builder', [
            'cards' => $this->cardsQuery()->paginate($this->perPage),
        ]);
    }
}
