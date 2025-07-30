<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Document creat cu succes!';
    }
}
