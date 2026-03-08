<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Master Suite',
                'slug' => 'master-suite',
                'bed_type' => 'King Bed',
                'bed_count' => 1,
                'sleeps' => 2,
                'description' => 'Ocean-facing suite with private balcony, walk-in closet, and luxury ensuite',
                'image_url' => 'https://img.rocket.new/generatedImages/rocket_gen_img_14b7848a4-1767976373764.png',
                'image_alt' => 'Master suite with king bed, ocean view balcony, and ensuite bathroom with rainfall shower',
                'rate_per_night' => 350.00,
                'is_available' => true,
                'sort_order' => 1,
                'amenities' => [
                    'Ocean View',
                    'Private Balcony',
                    'Walk-in Closet',
                    'Luxury Ensuite',
                    'Rainfall Shower',
                    'Air Conditioning',
                    'Smart TV'
                ]
            ],
            [
                'name' => 'Garden Suites',
                'slug' => 'garden-suites',
                'bed_type' => 'Queen Bed',
                'bed_count' => 1,
                'sleeps' => 2,
                'description' => 'Two identical suites overlooking lush tropical gardens with ensuite bathrooms',
                'image_url' => 'https://images.unsplash.com/photo-1594706667982-5ac495694f27',
                'image_alt' => 'Garden suite bedroom with queen bed, tropical garden view, and modern ensuite bathroom',
                'rate_per_night' => 275.00,
                'is_available' => true,
                'sort_order' => 2,
                'amenities' => [
                    'Garden View',
                    'Ensuite Bathroom',
                    'Air Conditioning',
                    'Smart TV',
                    'Coffee Maker',
                    'Mini Fridge'
                ]
            ],
            [
                'name' => 'Family Room',
                'slug' => 'family-room',
                'bed_type' => '2 Double Beds',
                'bed_count' => 2,
                'sleeps' => 4,
                'description' => 'Spacious room with twin double beds, perfect for families or friends traveling together',
                'image_url' => 'https://images.unsplash.com/photo-1591529865762-f84b1490ef8a',
                'image_alt' => 'Family bedroom with two double beds, colorful decor, and shared bathroom access',
                'rate_per_night' => 425.00,
                'is_available' => true,
                'sort_order' => 3,
                'amenities' => [
                    'Family Friendly',
                    'Spacious Layout',
                    'Air Conditioning',
                    'Smart TV',
                    'Coffee Maker',
                    'Mini Fridge',
                    'Extra Storage'
                ]
            ]
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
