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
        // 1. Committee Members (Trust Committee & Gam/Samaj Committee)
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_gu');
            $table->string('name_en');
            $table->string('designation_gu');
            $table->string('designation_en');
            $table->enum('committee_type', ['trust', 'gam'])->default('trust'); // trust or gam
            $table->string('village_gu')->nullable();
            $table->string('village_en')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo_url')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Photo & Video Gallery Items
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title_gu');
            $table->string('title_en');
            $table->string('category')->default('darshan'); // darshan, utsav, mandir, seva
            $table->string('image_url');
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // 3. Trust Activities (Annakshetra, Gaushala, Medical, etc.)
        Schema::create('trust_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title_gu');
            $table->string('title_en');
            $table->string('subtitle_gu')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->text('description_gu');
            $table->text('description_en');
            $table->string('icon')->default('fa-hand-holding-heart');
            $table->string('stats_gu')->nullable();
            $table->string('stats_en')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 4. Blog Posts & News / Utsavs
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_gu');
            $table->string('title_en');
            $table->string('slug')->unique();
            $table->text('excerpt_gu')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_gu');
            $table->longText('content_en');
            $table->string('image_url')->nullable();
            $table->date('published_date');
            $table->timestamps();
        });

        // 5. Live Darshan Information
        Schema::create('live_darshans', function (Blueprint $table) {
            $table->id();
            $table->string('title_gu');
            $table->string('title_en');
            $table->string('youtube_embed_id')->nullable(); // e.g. YouTube Live Stream ID
            $table->boolean('is_live')->default(true);
            $table->string('today_shringar_image')->nullable();
            $table->text('notice_gu')->nullable();
            $table->text('notice_en')->nullable();
            $table->timestamps();
        });

        // 6. Aarti Timings
        Schema::create('aarti_timings', function (Blueprint $table) {
            $table->id();
            $table->string('title_gu');
            $table->string('title_en');
            $table->string('time_gu');
            $table->string('time_en');
            $table->text('desc_gu')->nullable();
            $table->text('desc_en')->nullable();
            $table->string('badge_gu')->nullable();
            $table->string('badge_en')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 7. Donations Record
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no')->unique();
            $table->string('donor_name');
            $table->string('phone');
            $table->string('pan')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('cause');
            $table->string('payment_mode')->default('UPI');
            $table->string('status')->default('Verified');
            $table->timestamps();
        });

        // 8. Room Bookings
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->string('guest_name');
            $table->string('phone');
            $table->string('city');
            $table->string('room_type');
            $table->integer('rooms_count')->default(1);
            $table->integer('guests_count')->default(2);
            $table->date('check_in');
            $table->text('notes')->nullable();
            $table->string('status')->default('Pending'); // Pending, Approved, Completed, Cancelled
            $table->timestamps();
        });

        // 9. Contact Inquiries
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
        Schema::dropIfExists('room_bookings');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('aarti_timings');
        Schema::dropIfExists('live_darshans');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('trust_activities');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('committee_members');
    }
};
