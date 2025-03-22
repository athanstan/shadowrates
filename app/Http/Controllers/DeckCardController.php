<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeckCardController extends Controller
{
    /**
     * Add a card to the deck.
     */
    public function store(Request $request, Deck $deck)
    {
        // Make sure user can only modify their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to modify this deck.');
        }

        $validated = $request->validate([
            'card_id' => 'required|exists:cards,id',
            'quantity' => 'required|integer|min:1|max:3',
        ]);

        // Check if the card is already in the deck
        $existingCard = $deck->cards()->where('card_id', $validated['card_id'])->first();

        if ($existingCard) {
            // Update the quantity if the card is already in the deck
            $deck->cards()->updateExistingPivot($validated['card_id'], [
                'quantity' => $validated['quantity']
            ]);
        } else {
            // Add the card to the deck if it's not already there
            $deck->cards()->attach($validated['card_id'], [
                'quantity' => $validated['quantity']
            ]);
        }

        return redirect()->back()->with('success', 'Card added to deck successfully!');
    }

    /**
     * Update the quantity of a card in the deck.
     */
    public function update(Request $request, Deck $deck, Card $card)
    {
        // Make sure user can only modify their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to modify this deck.');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:3',
        ]);

        $deck->cards()->updateExistingPivot($card->id, [
            'quantity' => $validated['quantity']
        ]);

        return redirect()->back()->with('success', 'Card quantity updated successfully!');
    }

    /**
     * Remove a card from the deck.
     */
    public function destroy(Deck $deck, Card $card)
    {
        // Make sure user can only modify their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to modify this deck.');
        }

        $deck->cards()->detach($card->id);

        return redirect()->back()->with('success', 'Card removed from deck successfully!');
    }
}
