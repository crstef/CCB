<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'max_files',
        'files',
        'is_active',
    ];

    protected $casts = [
        'files' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the URL for a specific file
     */
    public function getFileUrl($index = 0)
    {
        if (!$this->files || !isset($this->files[$index])) {
            return null;
        }

        $file = $this->files[$index];
        return Storage::url($file['path']);
    }

    /**
     * Get all file URLs
     */
    public function getFileUrls()
    {
        if (!$this->files) {
            return [];
        }

        return collect($this->files)->map(function ($file) {
            return [
                'url' => Storage::url($file['path']),
                'name' => $file['name'],
                'size' => $file['size'] ?? null,
                'type' => $file['type'] ?? null,
            ];
        })->toArray();
    }

    /**
     * Get the number of uploaded files
     */
    public function getUploadedFilesCount()
    {
        return $this->files ? count($this->files) : 0;
    }

    /**
     * Check if more files can be uploaded
     */
    public function canUploadMoreFiles()
    {
        return $this->getUploadedFilesCount() < $this->max_files;
    }

    /**
     * Get available categories
     */
    public static function getCategories()
    {
        return [
            'General' => 'General',
            'Contracte' => 'Contracte',
            'Facturi' => 'Facturi',
            'Rapoarte' => 'Rapoarte',
            'Prezentări' => 'Prezentări',
            'Regulamente' => 'Regulamente',
            'Proceduri' => 'Proceduri',
            'Alte Documente' => 'Alte Documente',
        ];
    }

    /**
     * Scope for active documents
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get documents by category
     */
    public static function getByCategory($category)
    {
        return self::active()->byCategory($category)->orderBy('created_at', 'desc')->get();
    }
}
