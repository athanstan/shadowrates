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
        $this->user = User::where('slug', $slug)->firstOrFail();
    }

    #[Layout('components.app-layout')]
    public function render()
    {
        $decks = $this->user->decks()->latest()->take(6)->get();
        $cards = $this->user->cards()->latest()->take(8)->get();
        $ratings = $this->user->ratings()->with('card')->latest()->take(5)->get();

        return view('livewire.user.user-profile', [
            'decks' => $decks,
            'cards' => $cards,
            'ratings' => $ratings,
        ]);
    }
}
