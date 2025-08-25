<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

/**
 * Gallery Controller
 * 
 * Handles photo and video gallery pages.
 * All visible media items are shown, organized by type and video_category.
 * Carousel shows latest uploads in random order.
 */
class GalleryController extends Controller
{
    /**
     * Show all visible photos
     *
     * @return \Illuminate\View\View
     */
    public function photoGallery()
    {
        // Preia toate fotografiile vizibile din baza de date
        $photos = Media::where('media_type', 'image')
                      ->where('is_visible', true)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        // Debug: Log photo data
        \Log::info('Gallery Photos Debug:', [
            'total_photos' => $photos->count(),
            'first_photo' => $photos->first() ? [
                'id' => $photos->first()->id,
                'title' => $photos->first()->title,
                'file_path' => $photos->first()->file_path,
                'url' => $photos->first()->url,
                'full_url' => Storage::disk('public')->url($photos->first()->file_path),
            ] : null
        ]);
        
        return view('theme::pages.galerie-foto', compact('photos'));
    }

    /**
     * Show all visible videos with category filtering by video_category
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function videoGallery(Request $request)
    {
        $selectedCategory = $request->query('category');
        
        // Get videos by category or all if no category selected
        $videos = Media::getVideosByCategory($selectedCategory)->get();
        
        // Get all available video categories for filter
        $categories = Media::VIDEO_CATEGORIES;
        
        // Get videos grouped by category for organized display
        $videosByCategory = Media::getVideosGroupedByCategory();
        
        // Ensure we have the variables the view expects
        $data = compact('videos', 'categories', 'videosByCategory', 'selectedCategory');
        
        return view('theme::pages.galerie-video', $data);
    }
}
