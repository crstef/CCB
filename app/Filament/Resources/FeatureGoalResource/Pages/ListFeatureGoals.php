<?php

namespace App\Filament\Resources\FeatureGoalResource\Pages;

use App\Filament\Resources\FeatureGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeatureGoals extends ListRecords
{
    protected static string $resource = FeatureGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Adaugă obiectiv nou'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Obiective & Informații CCB';
    }
}
