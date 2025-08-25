<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

/**
 * Gallery Controller
 * 
 * Handles photo and video gallery pages.
 * All media is managed under the single "Gallery" category.
 */
class GalleryController extends Controller
{
    /**
     * Show all photos from Gallery category
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
     * Show all videos from Gallery category with category filtering
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
        
        return view('theme::pages.galerie-video', compact('videos', 'categories', 'videosByCategory', 'selectedCategory'));
    }
}
