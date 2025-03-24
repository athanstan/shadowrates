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
        $this->user = User::with(['decks' => function ($query) {
            $query->take(6);
        }, 'cards' => function ($query) {
            $query->take(8);
        }, 'ratings.card' => function ($query) {
            $query->take(5);
        }])->where('slug', $slug)->firstOrFail();
    }

    #[Layout('components.app-layout')]
    public function render()
    {
        return view('livewire.user.user-profile', [
            'decks' => $this->user->decks,
            'cards' => $this->user->cards,
            'ratings' => $this->user->ratings,
        ]);
    }
}
