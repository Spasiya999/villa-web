<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagline',
        'title_line_1',
        'title_line_2',
        'title_accent',
        'subtitle',
        'hero_image',
        'hero_video',
        'primary_cta_text',
        'primary_cta_link',
        'secondary_cta_text',
        'secondary_cta_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActive()
    {
        return self::where('is_active', true)->first() ?? self::first();
    }
}
