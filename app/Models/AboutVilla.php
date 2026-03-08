<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutVilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'main_image',
        'secondary_image',
        'feature_1_title',
        'feature_1_description',
        'feature_2_title',
        'feature_2_description',
        'feature_3_title',
        'feature_3_description',
        'feature_4_title',
        'feature_4_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active about villa section.
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first() ?? self::first();
    }
}
