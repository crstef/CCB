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
        // Since the original 'posts' table might be gone, we create 'events' from scratch.
        // This combines the original structure of 'posts' with the new event-specific fields.
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->boolean('featured')->default(0);
            $table->timestamps();

            // New event fields
            $table->string('location')->nullable();
            $table->text('disciplines')->nullable();
            $table->text('judges')->nullable();
            $table->date('event_start_date')->nullable();
            $table->date('booking_start_date')->nullable();
            $table->date('booking_end_date')->nullable();
            $table->string('caniva_link')->nullable();
        });

        Schema::create('category_event', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedBigInteger('event_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_event');
        Schema::dropIfExists('events');
    }
};
