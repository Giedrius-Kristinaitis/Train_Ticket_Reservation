<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'trip_id', 'price'
    ];

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo('App\Trip');
    }
}
