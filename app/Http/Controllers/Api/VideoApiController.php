<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Media API Controller for Video Gallery
 * 
 * Provides API endpoints for video gallery functionality
 */
class VideoApiController extends Controller
{
    /**
     * Get single media item details
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getMedia(int $id): JsonResponse
    {
        $media = Media::visible()->find($id);
        
        if (!$media) {
            return response()->json([
                'error' => 'Media not found'
            ], 404);
        }

        return response()->json([
            'id' => $media->id,
            'title' => $media->title,
            'description' => $media->description,
            'media_type' => $media->media_type,
            'video_source' => $media->video_source,
            'video_category' => $media->video_category,
            'youtube_id' => $media->youtube_id,
            'youtube_url' => $media->youtube_url,
            'file_path' => $media->file_path,
            'url' => $media->url,
            'mime_type' => $media->mime_type,
            'duration' => $media->duration,
            'formatted_duration' => $media->getFormattedDuration(),
            'thumbnail' => $media->getVideoThumbnail(),
            'embed_url' => $media->getVideoEmbedUrl(),
            'created_at' => $media->created_at,
        ]);
    }

    /**
     * Get videos by category
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getVideosByCategory(Request $request): JsonResponse
    {
        $category = $request->query('category');
        $limit = $request->query('limit', 20);
        
        $videos = Media::getVideosByCategory($category)
            ->limit($limit)
            ->get()
            ->map(function ($media) {
                return [
                    'id' => $media->id,
                    'title' => $media->title,
                    'description' => $media->description,
                    'video_source' => $media->video_source,
                    'video_category' => $media->video_category,
                    'thumbnail' => $media->getVideoThumbnail(),
                    'duration' => $media->getFormattedDuration(),
                    'created_at' => $media->created_at,
                ];
            });

        return response()->json([
            'videos' => $videos,
            'category' => $category,
            'categories' => Media::VIDEO_CATEGORIES,
        ]);
    }

    /**
     * Get videos grouped by category
     *
     * @return JsonResponse
     */
    public function getVideosGrouped(): JsonResponse
    {
        $videosByCategory = Media::getVideosGroupedByCategory();
        
        return response()->json([
            'videos_by_category' => $videosByCategory,
            'categories' => Media::VIDEO_CATEGORIES,
        ]);
    }
}
