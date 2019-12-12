<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'total_tickets', 'from', 'to', 'date', 'schedule_id', 'reserved_tickets', 'train_id'
    ];

    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany('App\Reservation');
    }

    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * @return BelongsTo
     */
    public function train(): BelongsTo
    {
        return $this->belongsTo('App\Train');
    }

    /**
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo('App\Schedule');
    }
}
