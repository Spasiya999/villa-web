<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'label',
        'sublabel',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all active highlights ordered by order column.
     */
    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get all highlights ordered by order column.
     */
    public static function getAllOrdered()
    {
        return self::orderBy('order')->get();
    }
}
