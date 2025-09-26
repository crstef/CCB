<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Partner extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'website_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope pentru parteneri activi
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pentru ordenarea partenerilor
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Configurează colecțiile media
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->useDisk('public');
    }

    /**
     * Configurează conversiile media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('logo');
    }

    /**
     * Accessor pentru URL-ul logo-ului
     */
    public function getLogoUrlAttribute()
    {
        $media = $this->getFirstMedia('logo');
        
        return $media ? $media->getUrl() : null;
    }

    /**
     * Accessor pentru URL-ul thumbnail-ului logo-ului
     */
    public function getLogoThumbUrlAttribute()
    {
        $media = $this->getFirstMedia('logo');
        
        return $media ? $media->getUrl('thumb') : null;
    }
}