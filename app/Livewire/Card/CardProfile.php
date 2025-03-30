<?php

namespace App\Livewire\Card;

use App\Livewire\ActionComponent;
use App\Livewire\Traits\HasCollectionActions;
use App\Models\Card;
use App\Models\CardUser;
use App\Models\Deck;
use App\Models\User;
use App\Traits\HasCardFilters;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

class CardProfile extends ActionComponent
{
    use HasCardFilters;
    use HasCollectionActions;

    public int $cardsInCollection = 0;
    public int $decksContainingCard = 0;
    public int $cardQuantity = 0;
    public Card $card;

    // Card collection management
    public CardUser $cardCollection;

    public function mount(Card $card)
    {
        $this->card = $card;

        if (Auth::check()) {
            $this->cardQuantity = CardUser::where('user_id', Auth::user()->id)
                ->where('card_id', $this->card->id)
                ->first()->quantity ?? 0;
        }
    }

    protected function getCollection(): array
    {
        return [
            'user_id' => Auth::user()->id,
            'card_id' => $this->card->id,
            'quantity' => $this->cardQuantity,
        ];
    }

    // Stats section
    #[Computed]
    public function totalDeckCount()
    {
        return Deck::count();
    }

    #[Computed]
    public function cardDeckCount()
    {
        return $this->card->decks->count();
    }

    #[Computed]
    public function tradingUsersCount()
    {
        return CardUser::where('card_id', $this->card->id)
            ->where('quantity', '>', 0)
            ->count();
    }

    #[Computed]
    public function wishlistUsersCount()
    {
        // Placeholder - assuming we'll implement wishlist feature later
        return mt_rand(0, 20); // Temporary random number for demo
    }

    #[Computed]
    public function relatedCards()
    {
        // Get cards from the same set with similar traits or cost
        return Card::query()
            ->where('id', '!=', $this->card->id)
            ->where(function ($query) {
                $query->where('card_set_id', $this->card->card_set_id)
                    ->orWhere('cost', $this->card->cost)
                    ->orWhere('card_type_id', $this->card->card_type_id);
            })
            ->limit(4)
            ->get();
    }

    #[Computed]
    public function wantedByPlayers()
    {
        // Get users who have this card in high quantities
        return User::query()
            ->whereHas('cards', function ($query) {
                $query->where('card_id', $this->card->id)
                    ->where('quantity', '>', 2);
            })
            ->limit(5)
            ->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.card.card-profile');
    }
}
