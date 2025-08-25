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
                ->modalHeading('Șterge Element Media')
                ->modalDescription('Sunteți sigur că doriți să ștergeți acest element media? Această acțiune nu poate fi anulată și va elimina fișierul din stocare.')
                ->modalSubmitActionLabel('Da, șterge-l'),
                
            Actions\RestoreAction::make(),
        ];
    }

    /**
     * Get the page title
     */
    public function getTitle(): string
    {
        return 'Editează: ' . $this->record->title;
    }

    /**
     * Get the page heading
     */
    public function getHeading(): string
    {
        return 'Editează Media';
    }

    /**
     * Get the page subheading
     */
    public function getSubheading(): ?string
    {
        return 'Actualizați informațiile media, încărcați fișiere noi sau schimbați URL-urile YouTube pentru video-uri.';
    }

    /**
     * Mutate form data before saving
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Validate that either file_path or youtube_url is provided
        if (empty($data['file_path']) && empty($data['youtube_url'])) {
            Notification::make()
                ->title('Eroare de Validare')
                ->body('Trebuie să încărcați un fișier sau să furnizați un URL YouTube.')
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
        
        // Auto-detect media type if mime_type changed
        if (isset($data['mime_type']) && $data['mime_type'] !== $this->record->mime_type && $data['mime_type'] !== 'video/youtube') {
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
            ->title('Media actualizată cu succes!')
            ->body('Elementul media a fost actualizat cu modificările dumneavoastră.')
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
