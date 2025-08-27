<?php

namespace App\Filament\Resources\FeatureGoalResource\Pages;

use App\Filament\Resources\FeatureGoalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeatureGoal extends CreateRecord
{
    protected static string $resource = FeatureGoalResource::class;
    
    public function getTitle(): string
    {
        return 'Creează obiectiv nou';
    }
}
