<?php

namespace App\Rules\Deck;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LeaderRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $leaderCollection = collect($value)
            ->where('card_type', 'Leader');

        $hasLeader = $leaderCollection
            ->isNotEmpty();

        if (!$hasLeader) {
            $fail("Your deck must contain at least one Leader card.");
        }

        // check how many leader cards are in the deck
        $leaderCount = $leaderCollection
            ->sum('quantity');

        if ($leaderCount > 1) {
            $fail("You can only have one Leader card in your deck.");
        }
    }
}
