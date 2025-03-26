<?php

namespace App\Livewire\User;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

class UserSettings extends Component
{
    public User $user;

    #[Rule('nullable|string|max:100')]
    public $country;

    #[Rule('nullable|string|max:100')]
    public $city;

    #[Rule('nullable|string|max:1000')]
    public $bio;

    #[Rule('nullable|string|max:50')]
    public $favorite_class;

    public $socialLinks = [];
    public $userSocialLinks = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->country = $this->user->country;
        $this->city = $this->user->city;
        $this->bio = $this->user->bio;
        $this->favorite_class = $this->user->favorite_class;

        // Load all available social links
        $this->socialLinks = SocialLink::all();

        // Load user's current social links
        $userLinks = $this->user->socialLinks;

        foreach ($this->socialLinks as $socialLink) {
            $userLink = $userLinks->where('id', $socialLink->id)->first();
            /** @phpstan-ignore-next-line */
            $this->userSocialLinks[$socialLink->id] = $userLink ? $userLink->pivot->value : '';
        }
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'country' => $this->country,
            'city' => $this->city,
            'bio' => $this->bio,
            'favorite_class' => $this->favorite_class,
        ]);

        // Update social links
        foreach ($this->userSocialLinks as $socialLinkId => $value) {
            if (!empty($value)) {
                $this->user->socialLinks()->syncWithoutDetaching([
                    $socialLinkId => ['value' => $value]
                ]);
            } else {
                $this->user->socialLinks()->detach($socialLinkId);
            }
        }

        $this->dispatch('settings-saved');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-settings');
    }
}
