<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * MediaApiController
 * 
 * API endpoints for frontend media consumption.
 * Used by the carousel and gallery components to load media data.
 * 
 * @package App\Http\Controllers\Api
 * @author Wave Framework
 * @version 1.0.0
 */
class MediaApiController extends Controller
{
    /**
     * Get media items for carousel display
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function carousel(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 10);
        
        // Get mix of images and videos for carousel
        $images = Media::getCarouselImages($limit - 2);
        $videos = Media::getCarouselVideos(2);
        
        $mediaItems = $images->merge($videos)->shuffle()->take($limit);
        
        $items = $mediaItems->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->url,
                'name' => $media->file_name,
                'title' => $media->title,
                'description' => $media->description,
                'type' => $media->media_type,
                'alt_text' => $media->alt_text,
                'is_featured' => $media->is_featured,
                'category' => $media->category,
                'tags' => $media->tags ?? [],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $items,
            'meta' => [
                'total' => $items->count(),
                'images' => $images->count(),
                'videos' => $videos->count(),
            ]
        ]);
    }

    /**
     * Get media items for photo gallery
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function photos(Request $request): JsonResponse
    {
        $photos = Media::getGalleryImages();
        
        $items = $photos->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->url,
                'fullUrl' => $media->url,
                'title' => $media->title,
                'description' => $media->description,
                'alt_text' => $media->alt_text,
                'tags' => $media->tags ?? [],
                'metadata' => $media->metadata ?? [],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $items,
            'meta' => [
                'total' => $items->count(),
            ]
        ]);
    }

    /**
     * Get media items for video gallery
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function videos(Request $request): JsonResponse
    {
        $videos = Media::getGalleryVideos();
        
        $items = $videos->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->url,
                'thumbnail' => $media->url, // Could add thumbnail generation later
                'title' => $media->title,
                'description' => $media->description,
                'duration' => $media->metadata['duration'] ?? null,
                'tags' => $media->tags ?? [],
                'metadata' => $media->metadata ?? [],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $items,
            'meta' => [
                'total' => $items->count(),
            ]
        ]);
    }

    /**
     * Get featured media items
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function featured(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 6);
        
        $featured = Media::visible()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
        
        $items = $featured->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->url,
                'title' => $media->title,
                'description' => $media->description,
                'type' => $media->media_type,
                'category' => $media->category,
                'alt_text' => $media->alt_text,
                'tags' => $media->tags ?? [],
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $items,
            'meta' => [
                'total' => $items->count(),
            ]
        ]);
    }
}
