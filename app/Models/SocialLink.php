<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SocialLink extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'link',
        'logo',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'social_link_user')
            ->withPivot('value')
            ->withTimestamps();
    }
}
