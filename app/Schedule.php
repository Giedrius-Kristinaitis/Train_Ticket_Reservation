<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    /**
     * @return HasMany
     */
    public function trips(): HasMany
    {
        return $this->hasMany('App\Trip');
    }
}
