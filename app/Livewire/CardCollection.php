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

    public function render()
    {
        $cards = Card::query()
            ->when($this->search, function (Builder $query) {
                return $query->where(function (Builder $query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCardType, function (Builder $query) {
                return $query->where('card_type_id', $this->selectedCardType);
            })
            ->when($this->selectedCraft, function (Builder $query) {
                return $query->where('craft_id', $this->selectedCraft);
            })
            ->when($this->selectedCardSet, function (Builder $query) {
                return $query->where('card_set_id', $this->selectedCardSet);
            })
            ->when($this->costFilter, function (Builder $query) {
                if ($this->costFilter === '9+') {
                    return $query->where('cost', '>=', 9);
                }
                return $query->where('cost', $this->costFilter);
            })
            ->when($this->rarityFilter, function (Builder $query) {
                return $query->where('rarity', $this->rarityFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.card-collection', [
            'cards' => $cards,
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
