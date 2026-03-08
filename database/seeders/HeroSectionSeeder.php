<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'tagline' => 'Beachfront · Private · Serene',
            'title_line_1' => 'Your Private',
            'title_line_2' => 'Paradise Awaits',
            'title_accent' => 'in Sri Lanka',
            'subtitle' => 'A secluded 4-bedroom estate where tropical luxury meets personalized service',
            'hero_image' => null,
            'primary_cta_text' => 'Book Your Stay',
            'primary_cta_link' => '#booking',
            'secondary_cta_text' => 'WhatsApp Us',
            'secondary_cta_link' => 'https://wa.me/94771234567',
            'is_active' => true,
        ]);
    }
}
