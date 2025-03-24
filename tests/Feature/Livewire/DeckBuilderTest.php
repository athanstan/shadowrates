<?php

use App\Livewire\DeckBuilder;
use function Pest\Livewire\livewire;

test('deck builder component loads successfully', function () {
    livewire(DeckBuilder::class)
        ->assertStatus(200);
});
