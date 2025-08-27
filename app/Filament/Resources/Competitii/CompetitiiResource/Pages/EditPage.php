<?php

namespace App\Filament\Resources\Competitii\CompetitiiResource\Pages;

use App\Filament\Resources\Competitii\CompetitiiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = CompetitiiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
