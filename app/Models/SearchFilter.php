<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchFilter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'filter_type',     // 'card', 'deck', etc.
        'filter_data',     // JSON encoded search parameters
        'is_default',      // Whether this is the user's default filter
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'filter_data' => 'array',
        'is_default' => 'boolean',
    ];

    /**
     * Get the user who owns this search filter.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Apply the search filter to a query.
     */
    public function applyToQuery($query)
    {
        // Implementation to apply the stored filter to a query builder
        // Would parse the filter_data and add where clauses

        // Example implementation (pseudocode):
        // foreach($this->filter_data as $key => $value) {
        //     $query->where($key, $value);
        // }

        return $query;
    }
}
