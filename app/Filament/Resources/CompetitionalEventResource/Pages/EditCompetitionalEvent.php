<?php

namespace App\Filament\Resources\CompetitionalEventResource\Pages;

use App\Filament\Resources\CompetitionalEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompetitionalEvent extends EditRecord
{
    protected static string $resource = CompetitionalEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editare Eveniment';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}