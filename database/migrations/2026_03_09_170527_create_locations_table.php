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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('label')->default('Where Paradise Meets Convenience');
            $table->string('title')->default('Perfectly positioned on Sri Lanka\'s southern coast');
            $table->text('description')->nullable();
            $table->text('map_embed_url')->nullable();
            
            $table->string('distance_1_icon')->default('palmtree');
            $table->string('distance_1_label')->default('Beach');
            $table->string('distance_1_value')->default('100m walk');
            
            $table->string('distance_2_icon')->default('shopping-bag');
            $table->string('distance_2_label')->default('Town Center');
            $table->string('distance_2_value')->default('5 min drive');
            
            $table->string('distance_3_icon')->default('plane');
            $table->string('distance_3_label')->default('Airport');
            $table->string('distance_3_value')->default('45 min drive');
            
            $table->string('distance_4_icon')->default('landmark');
            $table->string('distance_4_label')->default('Galle Fort');
            $table->string('distance_4_value')->default('20 min drive');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
