<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function photoGallery()
    {
        return view('pages.galerie-foto');
    }

    public function videoGallery()
    {
        return view('pages.galerie-video');
    }
}
