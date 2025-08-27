<?php

namespace App\Filament\Resources\DocumentCategoryResource\Pages;

use App\Filament\Resources\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\Section;

class ViewDocumentCategory extends ViewRecord
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informații Categorie')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nume')
                            ->weight('bold'),

                        TextEntry::make('slug')
                            ->label('Slug')
                            ->color('gray'),

                        TextEntry::make('description')
                            ->label('Descriere')
                            ->columnSpanFull(),

                        ColorEntry::make('color')
                            ->label('Culoare'),

                        TextEntry::make('sort_order')
                            ->label('Ordine Sortare'),

                        IconEntry::make('is_active')
                            ->label('Activ')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),

                        TextEntry::make('documents_count')
                            ->label('Număr Documente')
                            ->getStateUsing(fn ($record) => $record->documents()->count())
                            ->badge(),
                    ])
                    ->columns(2),

                Section::make('Metadate')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Creat la')
                            ->dateTime('d.m.Y H:i:s'),

                        TextEntry::make('updated_at')
                            ->label('Actualizat la')
                            ->dateTime('d.m.Y H:i:s'),
                    ])
                    ->columns(2),
            ]);
    }
}
