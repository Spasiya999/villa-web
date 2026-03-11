<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
        'map_embed_url',
        'distance_1_icon',
        'distance_1_label',
        'distance_1_value',
        'distance_2_icon',
        'distance_2_label',
        'distance_2_value',
        'distance_3_icon',
        'distance_3_label',
        'distance_3_value',
        'distance_4_icon',
        'distance_4_label',
        'distance_4_value',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active location section.
     */
    public static function getActive()
    {
        $location = self::where('is_active', true)->first() ?? self::first();

        if (!$location) {
            $location = self::create([
                'label' => 'Where Paradise Meets Convenience',
                'title' => 'Perfectly positioned on Sri Lanka\'s southern coast',
                'description' => 'Villa Lanka sits in the heart of Sri Lanka\'s most sought-after coastal region. You\'re steps from pristine beaches, minutes from vibrant local culture, and less than an hour from Colombo International Airport.',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126745.85768939493!2d79.77380039999999!3d6.927078699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sus',
                'distance_1_icon' => 'palmtree',
                'distance_1_label' => 'Beach',
                'distance_1_value' => '100m walk',
                'distance_2_icon' => 'shopping-bag',
                'distance_2_label' => 'Town Center',
                'distance_2_value' => '5 min drive',
                'distance_3_icon' => 'plane',
                'distance_3_label' => 'Airport',
                'distance_3_value' => '45 min drive',
                'distance_4_icon' => 'landmark',
                'distance_4_label' => 'Galle Fort',
                'distance_4_value' => '20 min drive',
                'is_active' => true,
            ]);
        }

        return $location;
    }
}
