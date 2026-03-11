<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Specific dummy reviews with good content
        $specificReviews = [
            [
                'name' => 'Sarah Mitchell',
                'location' => 'United Kingdom',
                'rating' => 5,
                'review' => 'Villa Lanka exceeded every expectation. The privacy, the service, the location — absolutely perfect. Our family felt like royalty for a week. The staff anticipated our every need, and the villa itself is even more stunning in person.',
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'name' => 'Michael Chen',
                'location' => 'Singapore',
                'rating' => 4,
                'review' => 'We\'ve stayed at luxury villas around the world, but Villa Lanka stands out. The attention to detail, the seamless blend of modern comfort and tropical beauty, and the incredibly warm hospitality made this our best vacation yet.',
                'is_active' => true,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'name' => 'Emma Rodriguez',
                'location' => 'United States',
                'rating' => 5,
                'review' => 'Pure magic. From the moment we arrived to our tearful goodbye, every second was perfection. The chef prepared incredible meals, the villa was spotless, and waking up to that ocean view never got old. Already planning our return.',
                'is_active' => true,
                'created_at' => now()->subWeeks(1),
                'updated_at' => now()->subWeeks(1),
            ],
        ];

        foreach ($specificReviews as $review) {
            Review::create($review);
        }

        // Generate 10 random fake reviews using the factory
        Review::factory(10)->create();
    }
}
