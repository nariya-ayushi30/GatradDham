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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            // 1. Top Banner
            $table->string('banner_badge_gu')->nullable();
            $table->string('banner_badge_en')->nullable();
            $table->string('banner_title_gu')->nullable();
            $table->string('banner_title_en')->nullable();
            $table->text('banner_subtitle_gu')->nullable();
            $table->text('banner_subtitle_en')->nullable();
            $table->string('hero_image')->nullable();

            // 2. Section 1: Divine Origin & Glory
            $table->string('sec1_title_gu')->nullable();
            $table->string('sec1_title_en')->nullable();
            $table->longText('sec1_content_gu')->nullable();
            $table->longText('sec1_content_en')->nullable();
            $table->string('sec1_image')->nullable();

            // 3. Sacred Shloka / Stuti
            $table->text('shlok_text')->nullable();
            $table->text('shlok_meaning_gu')->nullable();
            $table->text('shlok_meaning_en')->nullable();
            $table->string('shlok_badge_gu')->nullable();
            $table->string('shlok_badge_en')->nullable();

            // 4. Section 2: Pilgrimage Development & Trust
            $table->string('sec2_title_gu')->nullable();
            $table->string('sec2_title_en')->nullable();
            $table->longText('sec2_content_gu')->nullable();
            $table->longText('sec2_content_en')->nullable();
            $table->string('sec2_image')->nullable();

            // 5. Highlights / Key Pillars (4 Features)
            $table->string('feature1_title_gu')->nullable();
            $table->string('feature1_title_en')->nullable();
            $table->text('feature1_desc_gu')->nullable();
            $table->text('feature1_desc_en')->nullable();
            $table->string('feature1_icon')->nullable();

            $table->string('feature2_title_gu')->nullable();
            $table->string('feature2_title_en')->nullable();
            $table->text('feature2_desc_gu')->nullable();
            $table->text('feature2_desc_en')->nullable();
            $table->string('feature2_icon')->nullable();

            $table->string('feature3_title_gu')->nullable();
            $table->string('feature3_title_en')->nullable();
            $table->text('feature3_desc_gu')->nullable();
            $table->text('feature3_desc_en')->nullable();
            $table->string('feature3_icon')->nullable();

            $table->string('feature4_title_gu')->nullable();
            $table->string('feature4_title_en')->nullable();
            $table->text('feature4_desc_gu')->nullable();
            $table->text('feature4_desc_en')->nullable();
            $table->string('feature4_icon')->nullable();

            // 6. Trust Statistics
            $table->string('stat1_val')->nullable();
            $table->string('stat1_label_gu')->nullable();
            $table->string('stat1_label_en')->nullable();

            $table->string('stat2_val')->nullable();
            $table->string('stat2_label_gu')->nullable();
            $table->string('stat2_label_en')->nullable();

            $table->string('stat3_val')->nullable();
            $table->string('stat3_label_gu')->nullable();
            $table->string('stat3_label_en')->nullable();

            $table->string('stat4_val')->nullable();
            $table->string('stat4_label_gu')->nullable();
            $table->string('stat4_label_en')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};