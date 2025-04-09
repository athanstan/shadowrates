<?php

namespace App\Livewire\User;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Enums\Craft;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserSettings extends Component
{
    public User $user;
    public $country;
    public $city;
    public $bio;
    public $username;
    public $favorite_class;

    protected function rules()
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,name,' . $this->user->id],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'favorite_class' => ['required', 'string', Rule::enum(Craft::class)],
        ];
    }

    public $socialLinks = [];
    public $userSocialLinks = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->country = $this->user->country;
        $this->city = $this->user->city;
        $this->bio = $this->user->bio;
        $this->favorite_class = $this->user->favorite_class;
        $this->username = $this->user->name;

        // Load all available social links
        $this->socialLinks = SocialLink::all();

        // Load user's current social links
        $userLinks = $this->user->socialLinks;

        foreach ($this->socialLinks as $socialLink) {
            $userLink = $userLinks->where('id', $socialLink->id)->first();
            /** @phpstan-ignore-next-line */
            $this->userSocialLinks[$socialLink->id] = $userLink
                ? $userLink->pivot->value
                : '';
        }
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $this->user->update([
                'country' => $this->country,
                'city' => $this->city,
                'bio' => $this->bio,
                'favorite_class' => $this->favorite_class,
                'name' => $this->username,
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
        });

        $this->dispatch(
            'show-success',
            message: 'User settings saved successfully!'
        );
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-settings');
    }
}
