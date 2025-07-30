<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;
use Filament\Notifications\Notification;

/**
 * EditMedia Page - Filament Resource Page
 * 
 * Handles editing of existing media items with metadata
 * updates and file replacement capabilities.
 * 
 * @package App\Filament\Resources\MediaResource\Pages
 * @author Wave Framework
 * @version 1.0.0
 */
class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    /**
     * Get the header actions for this page
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Media Item')
                ->modalDescription('Are you sure you want to delete this media item? This action cannot be undone and will remove the file from storage.')
                ->modalSubmitActionLabel('Yes, delete it'),
                
            Actions\RestoreAction::make(),
        ];
    }

    /**
     * Get the page title
     */
    public function getTitle(): string
    {
        return 'Edit: ' . $this->record->title;
    }

    /**
     * Get the page heading
     */
    public function getHeading(): string
    {
        return 'Edit Media';
    }

    /**
     * Get the page subheading
     */
    public function getSubheading(): ?string
    {
        return 'Update media information, categorization, and display settings.';
    }

    /**
     * Mutate form data before saving
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Auto-detect media type if mime_type changed
        if (isset($data['mime_type']) && $data['mime_type'] !== $this->record->mime_type) {
            $data['media_type'] = str_starts_with($data['mime_type'], 'image/') ? 'image' : 'video';
        }

        return $data;
    }

    /**
     * Handle after save
     */
    protected function afterSave(): void
    {
        // Send success notification
        Notification::make()
            ->title('Media updated successfully!')
            ->body('The media item has been updated with your changes.')
            ->success()
            ->send();
    }

    /**
     * Get the redirect URL after saving
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
