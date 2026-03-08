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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('title_line_1')->nullable();
            $table->string('title_line_2')->nullable();
            $table->string('title_accent')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('primary_cta_text')->default('Book Your Stay');
            $table->string('primary_cta_link')->default('#booking');
            $table->string('secondary_cta_text')->default('WhatsApp Us');
            $table->string('secondary_cta_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
