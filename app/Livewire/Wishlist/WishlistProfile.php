<?php

namespace App\Livewire\Wishlist;

use App\Models\Wishlist;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class WishlistProfile extends Component
{
    public Wishlist $wishlist;

    public function mount($slug)
    {
        $this->wishlist = Wishlist::with([
            'cards' => function ($query) {
                $query->orderByRaw("CASE WHEN main_type = 'leader' THEN 0 ELSE 1 END")
                    ->orderBy('name');
            },
            'user'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        // Check if wishlist is public or belongs to authenticated user
        if (
            !$this->wishlist->is_public &&
            (!Auth::check() || Auth::id() !== $this->wishlist->user_id)
        ) {
            abort(403, 'This wishlist is private');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wishlist.wishlist-profile');
    }
}
