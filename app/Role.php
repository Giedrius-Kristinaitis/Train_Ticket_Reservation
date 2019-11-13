<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    const ROLE_REGULAR_USER = 'role_regular_user';
    const ROLE_MANAGER = 'role_manager';
    const ROLE_ADMIN = 'role_admin';

    /**
     * Gets the all users that have this role
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User');
    }
}