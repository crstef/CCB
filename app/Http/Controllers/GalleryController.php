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
        $photos = Media::getGalleryImages();
        
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
