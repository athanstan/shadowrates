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
                    ->with(
                        'cards',
                        fn($q) => $q->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                            ->orderBy('name')
                    );
            },
            'cards' => function ($query) {
                $query->orderBy('cards.created_at', 'desc')->take(20);
            }
        ])
            ->withCount(['decks'])
            ->withSum('cards as cards_count', 'card_user.quantity')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-profile');
    }
}
