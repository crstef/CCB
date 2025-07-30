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
        return 'Add photos or videos to your media gallery. Supported formats: JPG, PNG, GIF, WebP, MP4, WebM, MOV.';
    }

    /**
     * Mutate form data before creating the record
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure sort_order is set
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = 0;
        }

        // Auto-detect media type if not set
        if (!isset($data['media_type']) && isset($data['mime_type'])) {
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
