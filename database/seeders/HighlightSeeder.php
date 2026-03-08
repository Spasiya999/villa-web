<?php

namespace Database\Seeders;

use App\Models\Highlight;
use Illuminate\Database\Seeder;

class HighlightSeeder extends Seeder
{
    public function run(): void
    {
        $highlights = [
            ['icon' => 'bed-double', 'label' => '4 Bedrooms', 'sublabel' => 'Sleeps 8', 'order' => 0],
            ['icon' => 'waves', 'label' => 'Private Pool', 'sublabel' => 'Infinity Edge', 'order' => 1],
            ['icon' => 'palmtree', 'label' => 'Beach Access', 'sublabel' => '100m Walk', 'order' => 2],
            ['icon' => 'wifi', 'label' => 'Free Wi-Fi', 'sublabel' => 'High Speed', 'order' => 3],
            ['icon' => 'chef-hat', 'label' => 'Private Chef', 'sublabel' => 'On Request', 'order' => 4],
            ['icon' => 'plane', 'label' => 'Airport Transfer', 'sublabel' => 'Included', 'order' => 5],
        ];

        foreach ($highlights as $highlight) {
            Highlight::create($highlight);
        }
    }
}
