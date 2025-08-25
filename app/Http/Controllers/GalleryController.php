<?php

namespace    /**
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
    }ollers;

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
        
        return view('theme::pages.galerie-foto', compact('photos'));
    }

    /**
     * Show all videos from Gallery category
     *
     * @return \Illuminate\View\View
     */
    public function videoGallery()
    {
        $videos = Media::getGalleryVideos();
        
        return view('theme::pages.galerie-video', compact('videos'));
    }
}
