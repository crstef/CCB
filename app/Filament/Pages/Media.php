<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;

class MediaFiles extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static string $view = 'wave::media.index';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'File Manager';

    protected static ?string $title = 'File Manager';

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
