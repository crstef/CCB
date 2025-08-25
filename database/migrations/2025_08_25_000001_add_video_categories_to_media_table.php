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
        Schema::table('media', function (Blueprint $table) {
            // Add video category field
            $table->string('video_category')->nullable()->after('category');
            
            // Add video source type (local, youtube, vimeo, etc.)
            $table->enum('video_source', ['local', 'youtube', 'vimeo', 'other'])->default('local')->after('video_category');
            
            // Add video duration in seconds
            $table->integer('duration')->nullable()->after('video_source');
            
            // Add video quality/resolution
            $table->string('resolution')->nullable()->after('duration');
            
            // Add thumbnail URL for external videos
            $table->string('thumbnail_url')->nullable()->after('resolution');
            
            // Add embed parameters for YouTube/Vimeo
            $table->json('embed_params')->nullable()->after('thumbnail_url');
            
            // Add featured video flag
            $table->boolean('is_featured_video')->default(false)->after('embed_params');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn([
                'video_category',
                'video_source',
                'duration',
                'resolution',
                'thumbnail_url',
                'embed_params',
                'is_featured_video'
            ]);
        });
    }
};
