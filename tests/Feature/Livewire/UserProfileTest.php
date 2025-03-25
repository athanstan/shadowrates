<?php

namespace Tests\Feature\Livewire;

use App\Livewire\User\UserProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_profile_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.profile', $user->slug));

        $response->assertStatus(200);
    }

    /** @test */
    public function user_profile_component_can_be_rendered()
    {
        $user = User::factory()->create();

        Livewire::test(UserProfile::class, ['slug' => $user->slug])
            ->assertStatus(200)
            ->assertViewHas('user.decks')
            ->assertViewHas('user.cards');
    }
}
