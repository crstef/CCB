<?php

namespace App\Filament\Resources\FeatureGoalResource\Pages;

use App\Filament\Resources\FeatureGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeatureGoal extends EditRecord
{
    protected static string $resource = FeatureGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Șterge obiectivul'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Editează obiectivul';
    }
}
