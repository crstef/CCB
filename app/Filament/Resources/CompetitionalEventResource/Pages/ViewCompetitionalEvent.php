<?php

namespace App\Filament\Resources\CompetitionalEventResource\Pages;

use App\Filament\Resources\CompetitionalEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompetitionalEvent extends ViewRecord
{
    protected static string $resource = CompetitionalEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Vizualizare Eveniment';
    }
}