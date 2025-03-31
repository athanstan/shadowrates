<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

class UserWishlistIndex extends Component
{
    public User $user;

    public function mount(string $slug)
    {
        $this->user = User::with([
            'wishlists' => function ($query) {
                $query->orderBy('created_at', 'desc')
                    ->withCount('cards')
                    ->withSum('cards as total_quantity', 'card_wishlist.quantity');
            }
        ])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-wishlist-index');
    }
}
