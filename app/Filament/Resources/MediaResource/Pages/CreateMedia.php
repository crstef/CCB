<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

/**
 * CreateMedia Page - Filament Resource Page
 * 
 * Handles the creation of new media items with file upload
 * and automatic metadata detection.
 * 
 * @package App\Filament\Resources\MediaResource\Pages
 * @author Wave Framework
 * @version 1.0.0
 */
class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    /**
     * Get the page title
     */
    public function getTitle(): string
    {
        return 'Upload New Media';
    }

    /**
     * Get the page heading
     */
    public function getHeading(): string
    {
        return 'Upload New Media';
    }

    /**
     * Get the page subheading
     */
    public function getSubheading(): ?string
    {
        return 'Add photos or videos to your media gallery. Upload files or provide YouTube URLs for videos. Supported formats: JPG, PNG, GIF, WebP, MP4, WebM, MOV.';
    }

    /**
     * Mutate form data before creating the record
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Validate that either file_path or youtube_url is provided
        if (empty($data['file_path']) && empty($data['youtube_url'])) {
            Notification::make()
                ->title('Validation Error')
                ->body('You must either upload a file or provide a YouTube URL.')
                ->danger()
                ->send();
            
            $this->halt();
        }
        
        // If YouTube URL is provided, set appropriate metadata
        if (!empty($data['youtube_url'])) {
            $data['mime_type'] = 'video/youtube';
            $data['media_type'] = 'video';
            
            // Extract filename from YouTube URL for reference
            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $data['youtube_url'], $matches)) {
                $data['file_name'] = 'youtube_' . $matches[1] . '.mp4';
            }
        }
        
        // Ensure sort_order is set
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        // Auto-detect media type if not set
        if (!isset($data['media_type']) && isset($data['mime_type']) && $data['mime_type'] !== 'video/youtube') {
            $data['media_type'] = str_starts_with($data['mime_type'], 'image/') ? 'image' : 'video';
        }

        return $data;
    }

    /**
     * Handle after creation
     */
    protected function afterCreate(): void
    {
        // Send success notification
        Notification::make()
            ->title('Media uploaded successfully!')
            ->body('Your media file has been uploaded and is now available in the gallery.')
            ->success()
            ->send();
    }

    /**
     * Get the redirect URL after creation
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
