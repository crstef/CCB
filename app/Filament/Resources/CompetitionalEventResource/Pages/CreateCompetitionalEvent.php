<?php

namespace App\Filament\Resources\CompetitionalEventResource\Pages;

use App\Filament\Resources\CompetitionalEventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompetitionalEvent extends CreateRecord
{
    protected static string $resource = CompetitionalEventResource::class;

    public function getTitle(): string
    {
        return 'Adaugă Eveniment Competițional';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}