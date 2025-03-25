<?php

namespace App\Actions\Deck;

final class SaveDeck
{
    public function __construct(
        public string $deckName,
        public array $mainDeck,
        public array $evolutionDeck,
        public int $leaderCardId,
    ) {}

    public function execute(): void {}
}
