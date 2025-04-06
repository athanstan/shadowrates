<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

class UserProfile extends Component
{
    public User $user;

    public function mount($slug)
    {
        $this->user = User::with([
            'decks' => function ($query) {
                $query->orderBy('decks.created_at', 'desc')
                    ->withCount('cards')
                    ->withSum('cards as cards_count', 'deck_cards.quantity')
                    ->withLeader()
                    ->with([
                        'cards' => fn($q) => $q->with([
                            'craft:id,name'
                        ])
                            ->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                            ->orderBy('name'),
                    ]);
            },
            'cards' => function ($query) {
                $query
                    ->with([
                        'cardType:id,name',
                        'craft:id,name',
                        'cardSet:id,name',
                    ])
                    ->orderBy('cards.created_at', 'desc')->take(18);
            }
        ])
            ->withCount(['decks'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-profile');
    }
}
