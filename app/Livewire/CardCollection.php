<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\CardUser;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use App\Traits\HasCardFilters;
use Livewire\Attributes\Layout;

class CardCollection extends Component
{
    use HasCardFilters;

    // Additional properties specific to CardCollection
    public $ownedFilter = false;
    public array $cardCollection = [];
    protected $queryString = [];

    public function boot()
    {
        $this->queryString = array_merge(
            $this->getCardFilterQueryString(),
            ['ownedFilter' => ['except' => false]]
        );
    }

    public function mount()
    {
        $this->initializeCardFilters();

        if (Auth::check()) {
            $this->cardCollection = CardUser::query()
                ->where('user_id', Auth::user()->id)
                ->where('quantity', '>', 0)
                ->pluck('quantity', 'card_id')
                ->toArray();
        }
    }

    public function updatingOwnedFilter()
    {
        $this->resetPage();
    }

    public function saveCardCollection()
    {
        $userCards = [];
        foreach ($this->cardCollection as $cardId => $quantity) {
            $userCards[$cardId] = ['quantity' => $quantity];
        }

        try {
            Auth::user()->cards()->syncWithoutDetaching($userCards);
            $this->dispatch('show-success', message: 'Card collection saved successfully!');
        } catch (\Exception) {
            $this->dispatch('show-error', message: 'Failed to save card collection. Please try again.');
        }
    }

    #[Computed]
    public function cardsQuery(): Builder
    {
        $query = Card::query();

        $query = $this->applyCardFilters($query);

        if ($this->ownedFilter) {
            $query->whereIn('id', array_keys($this->cardCollection));
        }

        return $query;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.card-collection', [
            'cards' => $this->cardsQuery()->paginate($this->perPage),
        ]);
    }

    public function resetFilters(): void
    {
        $this->reset([
            'search',
            'selectedCardType',
            'selectedCardSubType',
            'selectedCraft',
            'selectedCardSet',
            'costFilter',
            'rarityFilter',
            'ownedFilter'
        ]);

        $this->resetPage();
    }
}
