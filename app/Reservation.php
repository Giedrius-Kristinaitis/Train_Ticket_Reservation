<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'ticket_count', 'user_id', 'trip_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo('App\Trip');
    }
}
