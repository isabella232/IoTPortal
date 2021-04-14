<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'raw_data',
    ];

    /**
     * Get the event that owns the event history.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeRawDataLike($query, $value)
    {
        return $query->where('raw_data', 'like', "%{$value}%");
    }

    public function scopeEventId($query, $value)
    {
        return $query->where('event_id', $value);
    }

    public function scopeCreatedAtBetween($query, $dates)
    {
        return $query->whereBetween('created_at', $dates);
    }


}