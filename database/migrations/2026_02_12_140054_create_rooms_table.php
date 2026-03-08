<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('bed_type'); // e.g., 'King Bed', 'Queen Bed', '2 Double Beds'
            $table->integer('bed_count')->default(1);
            $table->integer('sleeps');
            $table->text('description');
            $table->string('image_url');
            $table->text('image_alt');
            $table->decimal('rate_per_night', 8, 2)->nullable();
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('amenities')->nullable(); // Additional amenities as JSON array
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
