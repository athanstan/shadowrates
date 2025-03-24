<?php

namespace App\Http\Controllers;

use App\Models\Craft;
use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $decks = Auth::user()->decks()->latest()->paginate(12);
        return view('decks.index', ['decks' => $decks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $crafts = Craft::where('is_active', true)->orderBy('display_order')->get();
        // @phpstan-ignore-next-line
        return view('decks.create', ['crafts' => $crafts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'craft_id' => 'required|exists:crafts,id',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'format' => 'required|integer|min:1|max:3',
        ]);

        $deck = new Deck($validated);
        $deck->user_id = Auth::id();
        $deck->save();

        return redirect()->route('decks.show', $deck)
            ->with('success', 'Deck created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        // Make sure user can only see their private decks
        if (!$deck->is_public && $deck->user_id !== Auth::id()) {
            abort(403, 'This deck is private.');
        }

        return view('decks.show', ['deck' => $deck]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck)
    {
        // Make sure user can only edit their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to edit this deck.');
        }

        $crafts = Craft::where('is_active', true)->orderBy('display_order')->get();
        // @phpstan-ignore-next-line
        return view('decks.edit', ['deck' => $deck, 'crafts' => $crafts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck)
    {
        // Make sure user can only update their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to update this deck.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'craft_id' => 'required|exists:crafts,id',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'format' => 'required|integer|min:1|max:3',
        ]);

        $deck->update($validated);

        return redirect()->route('decks.show', $deck)
            ->with('success', 'Deck updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        // Make sure user can only delete their decks
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to delete this deck.');
        }

        $deck->delete();

        return redirect()->route('decks.index')
            ->with('success', 'Deck deleted successfully!');
    }
}
