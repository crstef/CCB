<?php

namespace App\Filament\Resources\CompetitionalEventResource\Pages;

use App\Filament\Resources\CompetitionalEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompetitionalEvents extends ListRecords
{
    protected static string $resource = CompetitionalEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Adaugă Eveniment'),
        ];
    }

    public function getTitle(): string
    {
        return 'Calendar Competițional';
    }
}