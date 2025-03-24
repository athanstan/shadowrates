<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the user's avatar URL, generating a default if none exists.
     */
    public function getAvatarAttribute($value)
    {
        if ($value) {
            return $value;
        }

        $apiUrl = config('services.dicebear.api_url');
        $style = config('services.dicebear.style');
        $seed = $this->email ?? $this->id;

        return "{$apiUrl}/{$style}/svg?seed={$seed}";
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    /**
     * Get the decks created by the user.
     */
    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class);
    }

    /**
     * Get the ratings created by the user.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }


    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class)
            ->withPivot(['quantity'])
            ->withTimestamps()
            ->as('collection_item');
    }

    /**
     * Get the saved search filters for this user.
     */
    public function searchFilters(): HasMany
    {
        return $this->hasMany(SearchFilter::class);
    }

    /**
     * Get the default search filter for this user.
     */
    public function defaultSearchFilter(): HasOne
    {
        return $this->hasOne(SearchFilter::class)->where('is_default', true);
    }

    /**
     * Get the URL for the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->provider_avatar ?? $this->getAvatarAttribute(null);
    }
}
