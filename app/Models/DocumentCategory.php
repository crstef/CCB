<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the documents for this category.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get active documents for this category.
     */
    public function activeDocuments()
    {
        return $this->hasMany(Document::class)->where('is_active', true);
    }

    /**
     * Scope for active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered categories.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get all active categories for dropdown.
     */
    public static function getActiveOptions()
    {
        return self::active()->ordered()->pluck('name', 'id')->toArray();
    }

    /**
     * Get all categories with document count.
     */
    public static function withDocumentCount()
    {
        return self::withCount(['documents' => function ($query) {
            $query->where('is_active', true);
        }])->ordered()->get();
    }

    /**
     * Get the documents count attribute.
     */
    public function getDocumentsCountAttribute()
    {
        return $this->documents()->where('is_active', true)->count();
    }
}
