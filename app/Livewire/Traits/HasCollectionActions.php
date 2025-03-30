<?php

namespace App\Livewire\Traits;

use App\Models\CardUser;
use Exception;
use Illuminate\Support\Facades\Auth;

trait HasCollectionActions
{
    public function authorizeAction(): void
    {
        if (!Auth::check()) {
            throw new Exception('Unauthorized action');
        }
    }

    public function removeFromCollection(): void {}

    public function saveCollection(): void
    {
        $this->authorizeAction();

        $collection = $this->getCollection();

        try {
            CardUser::updateOrCreate(
                [
                    'user_id' => $collection['user_id'],
                    'card_id' => $collection['card_id'],
                ],
                [
                    'quantity' => $collection['quantity']
                ]
            );

            $this->dispatch('show-success', message: 'Collection updated successfully!');
        } catch (\Exception $e) {
            $this->dispatch('show-error', message: 'Failed to update collection: ' . $e->getMessage());
        }
    }

    /**
     * Get the a collection of cards per user and use it to either
     * add or remove a card from the collection
     *
     * @return array{
     *    user_id: int,
     *    card_id: int,
     *    quantity: int
     * } Collection data with required fields
     */
    protected abstract function getCollection(): array;
}
