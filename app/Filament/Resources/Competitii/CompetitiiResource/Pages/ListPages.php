<?php

namespace App\Filament\Resources\Competitii\CompetitiiResource\Pages;

use App\Filament\Resources\Competitii\CompetitiiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = CompetitiiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
