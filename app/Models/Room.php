<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'bed_type',
        'bed_count',
        'sleeps',
        'description',
        'image_url',
        'image_alt',
        'rate_per_night',
        'is_available',
        'sort_order',
        'amenities'
    ];

    protected $casts = [
        'rate_per_night' => 'decimal:2',
        'is_available' => 'boolean',
        'amenities' => 'array',
        'bed_count' => 'integer',
        'sleeps' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Get formatted rate
     */
    public function getFormattedRateAttribute()
    {
        return '$' . number_format($this->rate_per_night, 2);
    }

    /**
     * Scope for available rooms only
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope for ordering by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class)->orderBy('sort_order');
    }

    public static function getActive()
    {
        return self::available()->ordered()->get() ?? self::ordered()->get();
    }
}
