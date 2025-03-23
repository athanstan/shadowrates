<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\CardSet;
use App\Models\CardType;
use App\Models\Craft;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class CardCollection extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $selectedCardType = '';
    public $selectedCraft = '';
    public $selectedCardSet = '';
    public $costFilter = '';
    public $rarityFilter = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 24;

    // Dropdown options
    public $cardTypes = [];
    public $crafts = [];
    public $cardSets = [];
    public $rarities = ['Bronze', 'Silver', 'Gold', 'Legendary'];
    public $costs = ['1', '2', '3', '4', '5', '6', '7', '8', '9+'];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCardType' => ['except' => ''],
        'selectedCraft' => ['except' => ''],
        'selectedCardSet' => ['except' => ''],
        'costFilter' => ['except' => ''],
        'rarityFilter' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        $this->cardTypes = CardType::orderBy('name')->get();
        $this->crafts = Craft::orderBy('name')->get();
        $this->cardSets = CardSet::orderBy('release_date', 'desc')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCardType()
    {
        $this->resetPage();
    }

    public function updatingSelectedCraft()
    {
        $this->resetPage();
    }

    public function updatingSelectedCardSet()
    {
        $this->resetPage();
    }

    public function updatingCostFilter()
    {
        $this->resetPage();
    }

    public function updatingRarityFilter()
    {
        $this->resetPage();
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

    public function getCardsQueryProperty(): Builder
    {
        return Card::query()
            ->when(
                strlen($this->search) >= 3,
                fn(Builder $query) =>
                $query->where(
                    fn(Builder $query) =>
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                )
            )
            ->when(
                $this->selectedCardType,
                fn(Builder $query) =>
                $query->where('card_type_id', $this->selectedCardType)
            )
            ->when(
                $this->selectedCraft,
                fn(Builder $query) =>
                $query->where('craft_id', $this->selectedCraft)
            )
            ->when(
                $this->selectedCardSet,
                fn(Builder $query) =>
                $query->where('card_set_id', $this->selectedCardSet)
            )
            ->when(
                $this->costFilter,
                fn(Builder $query) =>
                $this->costFilter === '9+'
                    ? $query->where('cost', '>=', 9)
                    : $query->where('cost', $this->costFilter)
            )
            ->when(
                $this->rarityFilter,
                fn(Builder $query) =>
                $query->where('rarity', $this->rarityFilter)
            )
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.card-collection', [
            'cards' => $this->cardsQuery->paginate($this->perPage),
        ]);
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'selectedCardType',
            'selectedCraft',
            'selectedCardSet',
            'costFilter',
            'rarityFilter'
        ]);
        $this->resetPage();
    }
}
