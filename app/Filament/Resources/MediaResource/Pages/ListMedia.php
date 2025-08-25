<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;

/**
 * ListMedia Page - Filament Resource Page
 * 
 * Displays the listing page for media items with advanced
 * filtering, searching, and bulk operations capabilities.
 * 
 * @package App\Filament\Resources\MediaResource\Pages
 * @author Wave Framework
 * @version 1.0.0
 */
class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    /**
     * Get the header actions for this page
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Încărcare Media')
                ->icon('heroicon-o-cloud-arrow-up'),
        ];
    }

    /**
     * Get the maximum content width for this page
     */
    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    /**
     * Get the page title
     */
    public function getTitle(): string
    {
        return 'Galeria Media';
    }

    /**
     * Get the page heading
     */
    public function getHeading(): string
    {
        return 'Administrare Galerie Media';
    }

    /**
     * Get the page subheading
     */
    public function getSubheading(): ?string
    {
        return 'Administrați pozele și video-urile pentru galeriile și afișajele carusel.';
    }
}
