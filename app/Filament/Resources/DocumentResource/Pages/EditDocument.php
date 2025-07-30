<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Extract file paths for the form
        if (isset($data['files']) && is_array($data['files'])) {
            $data['files'] = collect($data['files'])->pluck('path')->toArray();
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Process the uploaded files to store metadata
        if (isset($data['files']) && is_array($data['files'])) {
            $processedFiles = [];
            
            foreach ($data['files'] as $filePath) {
                if ($filePath) {
                    $fullPath = storage_path('app/public/' . $filePath);
                    $processedFiles[] = [
                        'path' => $filePath,
                        'name' => basename($filePath),
                        'size' => file_exists($fullPath) ? filesize($fullPath) : null,
                        'type' => Storage::mimeType('public/' . $filePath),
                        'uploaded_at' => now()->toDateTimeString(),
                    ];
                }
            }
            
            $data['files'] = $processedFiles;
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Document actualizat cu succes!';
    }
}
