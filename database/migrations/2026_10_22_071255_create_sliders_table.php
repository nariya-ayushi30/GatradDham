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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_gu')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_gu')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_text_gu')->nullable();
            $table->string('button_link')->nullable();
            $table->string('image');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
