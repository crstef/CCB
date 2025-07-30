<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Media Gallery Migration
 * 
 * Creates the media table for managing photos and videos
 * in the gallery system with comprehensive metadata support.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            
            // Basic file information
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->bigInteger('file_size')->nullable();
            $table->string('mime_type')->nullable();
            
            // Media categorization
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->enum('category', [
                'gallery', 
                'carousel', 
                'hero', 
                'events', 
                'members', 
                'training', 
                'competitions', 
                'other'
            ])->default('gallery');
            
            // Display settings
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            
            // SEO and accessibility
            $table->string('alt_text')->nullable();
            $table->json('tags')->nullable();
            
            // Additional metadata (dimensions, duration, etc.)
            $table->json('metadata')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['media_type', 'is_visible']);
            $table->index(['category', 'is_visible']);
            $table->index(['is_featured', 'is_visible']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
