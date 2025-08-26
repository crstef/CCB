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
        
        // Handle both old format (string) and new format (array)
        if (is_string($file)) {
            return Storage::url($file);
        } elseif (is_array($file) && isset($file['path'])) {
            return Storage::url($file['path']);
        }
        
        return null;
    }

    /**
     * Get all file URLs with original names
     */
    public function getFileUrls()
    {
        if (!$this->files) {
            return [];
        }

        return collect($this->files)->map(function ($file) {
            // Handle both old format (string) and new format (array)
            if (is_string($file)) {
                // Old format - just a file path
                $fileName = basename($file);
                
                return [
                    'url' => Storage::url($file),
                    'path' => $file,
                    'name' => $fileName,
                    'original_name' => $fileName,
                    'size' => Storage::exists($file) ? Storage::size($file) : null,
                    'size_formatted' => Storage::exists($file) ? $this->formatFileSize(Storage::size($file)) : 'N/A',
                    'type' => pathinfo($file, PATHINFO_EXTENSION),
                    'mime_type' => Storage::exists($file) ? Storage::mimeType($file) : null,
                ];
            } elseif (is_array($file) && isset($file['path'])) {
                // New format - array with metadata
                $filePath = $file['path'];
                $fileName = $file['name'] ?? basename($filePath);
                
                return [
                    'url' => Storage::url($filePath),
                    'path' => $filePath,
                    'name' => $fileName,
                    'original_name' => $fileName,
                    'size' => $file['size'] ?? (Storage::exists($filePath) ? Storage::size($filePath) : null),
                    'size_formatted' => isset($file['size']) ? $this->formatFileSize($file['size']) : (Storage::exists($filePath) ? $this->formatFileSize(Storage::size($filePath)) : 'N/A'),
                    'type' => pathinfo($filePath, PATHINFO_EXTENSION),
                    'mime_type' => Storage::exists($filePath) ? Storage::mimeType($filePath) : null,
                    'uploaded_at' => $file['uploaded_at'] ?? null,
                ];
            }
            
            return null;
        })->filter()->toArray(); // Filter out null values
    }

    /**
     * Format file size to human readable format
     */
    private function formatFileSize($bytes)
    {
        if ($bytes == 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;
        
        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }
        
        return round($bytes, 1) . ' ' . $units[$unitIndex];
    }

        /**
     * Check if file can be viewed inline (now supports all document types)
     */
    public function canViewInline($fileIndex = 0)
    {
        if (!$this->files || !isset($this->files[$fileIndex])) {
            return false;
        }

        $file = $this->files[$fileIndex];
        
        // Handle both old format (string) and new format (array)
        $filePath = null;
        if (is_string($file)) {
            $filePath = $file;
        } elseif (is_array($file) && isset($file['path'])) {
            $filePath = $file['path'];
        }
        
        if (!$filePath) {
            return false;
        }
        
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        // Support inline viewing for most document types
        return in_array($extension, [
            'pdf',           // PDF documents
            'doc', 'docx',   // Microsoft Word
            'xls', 'xlsx',   // Microsoft Excel
            'ppt', 'pptx',   // Microsoft PowerPoint
            'txt',           // Text files
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', // Images
            'html', 'htm',   // HTML files
        ]);
    }

    /**
     * Get file icon class based on extension
     */
    public function getFileIconClass($fileIndex = 0)
    {
        if (!$this->files || !isset($this->files[$fileIndex])) {
            return 'text-gray-500';
        }

        $file = $this->files[$fileIndex];
        
        // Handle both old format (string) and new format (array)
        $filePath = null;
        if (is_string($file)) {
            $filePath = $file;
        } elseif (is_array($file) && isset($file['path'])) {
            $filePath = $file['path'];
        }
        
        if (!$filePath) {
            return 'text-gray-500';
        }
        
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        return match($extension) {
            'pdf' => 'text-red-500',
            'doc', 'docx' => 'text-blue-500',
            'xls', 'xlsx' => 'text-green-500',
            'ppt', 'pptx' => 'text-orange-500',
            'jpg', 'jpeg', 'png', 'gif' => 'text-purple-500',
            'txt' => 'text-gray-600',
            default => 'text-gray-500',
        };
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
