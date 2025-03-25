<?php

namespace App\Livewire\Card;

use App\Models\Card;
use App\Models\CardUser;
use App\Models\Deck;
use App\Models\User;
use App\Traits\HasCardFilters;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

class CardProfile extends Component
{
    use HasCardFilters;

    public Card $card;

    // Card collection management
    public array $cardCollection = [];

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

    public function mount(Card $card)
    {
        $this->card = $card;
        $this->initializeCardFilters();

        if (Auth::check()) {
            $this->cardCollection = CardUser::query()
                ->where('user_id', Auth::user()->id)
                ->where('quantity', '>', 0)
                ->pluck('quantity', 'card_id')
                ->toArray();
        }
    }

    public function addToCollection()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->cardCollection[$this->card->id] = ($this->cardCollection[$this->card->id] ?? 0) + 1;
        $this->saveCollection();
    }

    public function removeFromCollection()
    {
        if (!Auth::check() || !isset($this->cardCollection[$this->card->id]) || $this->cardCollection[$this->card->id] <= 0) {
            return;
        }

        $this->cardCollection[$this->card->id] = max(0, $this->cardCollection[$this->card->id] - 1);
        $this->saveCollection();
    }

    private function saveCollection()
    {
        $userCards = [];
        foreach ($this->cardCollection as $cardId => $quantity) {
            if ($quantity > 0) {
                $userCards[$cardId] = ['quantity' => $quantity];
            }
        }

        try {
            Auth::user()->cards()->syncWithoutDetaching($userCards);
            $this->dispatch('show-success', message: 'Card collection updated successfully!');
        } catch (\Exception) {
            $this->dispatch('show-error', message: 'Failed to update card collection. Please try again.');
        }
    }

    #[Layout('components.app-layout')]
    public function render()
    {
        return view('livewire.card.card-profile');
    }
}
