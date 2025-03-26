<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSocialLink extends Pivot
{
    protected $table = 'social_link_user';

    protected $fillable = [
        'user_id',
        'social_link_id',
        'value',
    ];
}
