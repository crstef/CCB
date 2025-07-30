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
        'document_category_id',
        'max_files',
        'files',
        'is_active',
    ];

    protected $casts = [
        'files' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the category that owns the document.
     */
    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    /**
     * Get the URL for a specific file
     */
    public function getFileUrl($index = 0)
    {
        if (!$this->files || !isset($this->files[$index])) {
            return null;
        }

        $file = $this->files[$index];
        // Ensure $file is a string before using it
        if (!is_string($file)) {
            return null;
        }
        
        return Storage::url($file);
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
            // Ensure $file is a string before processing
            if (!is_string($file)) {
                return null;
            }
            
            return [
                'url' => Storage::url($file),
                'name' => basename($file),
                'size' => null, // File size will need to be calculated if needed
                'type' => pathinfo($file, PATHINFO_EXTENSION),
            ];
        })->filter()->toArray(); // Filter out null values
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
     * Get available categories - now removed since we use dynamic categories
     */
    // Removed getCategories() method - categories are now managed in DocumentCategory model

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
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('document_category_id', $categoryId);
    }

    /**
     * Get documents by category
     */
    public static function getByCategory($categoryId)
    {
        return self::active()->byCategory($categoryId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get the file path for the first file
     */
    public function getFilePathAttribute()
    {
        if (!$this->files || empty($this->files)) {
            return null;
        }

        $firstFile = $this->files[0] ?? null;
        // Ensure the first file is a string before returning
        return is_string($firstFile) ? $firstFile : null;
    }

    /**
     * Get the file size in a human-readable format
     */
    public function getFileSizeFormatted()
    {
        if (!$this->files || empty($this->files)) {
            return 'N/A';
        }

        // Try to get file size from storage
        $filePath = $this->files[0];
        // Ensure $filePath is a string before using Storage methods
        if (!is_string($filePath)) {
            return 'N/A';
        }
        
        if (Storage::exists($filePath)) {
            $sizeInBytes = Storage::size($filePath);
        } else {
            return 'N/A';
        }
        
        if ($sizeInBytes == 0) {
            return 'N/A';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;
        
        while ($sizeInBytes >= 1024 && $unitIndex < count($units) - 1) {
            $sizeInBytes /= 1024;
            $unitIndex++;
        }
        
        return round($sizeInBytes, 1) . ' ' . $units[$unitIndex];
    }

    /**
     * Get file size property
     */
    public function getFileSizeAttribute()
    {
        if (!$this->files || empty($this->files)) {
            return null;
        }

        $filePath = $this->files[0];
        // Ensure $filePath is a string before using Storage methods
        if (!is_string($filePath)) {
            return null;
        }
        
        if (Storage::exists($filePath)) {
            return Storage::size($filePath);
        }

        return null;
    }
}
