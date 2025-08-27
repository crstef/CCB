<?php

namespace App\Filament\Resources\Competitii\CategoriiCompetitiiResource\Pages;

use App\Filament\Resources\Competitii\CategoriiCompetitiiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoriiCompetitiiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
