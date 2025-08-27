<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class ViewDocument extends ViewRecord
{
    protected static string $resource = DocumentResource::class;

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
                Section::make('Informații Document')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Titlu')
                            ->weight('bold'),

                        TextEntry::make('description')
                            ->label('Descriere')
                            ->columnSpanFull(),

                        TextEntry::make('category.name')
                            ->label('Categorie')
                            ->badge()
                            ->color(fn ($record) => $record->category?->color ?? '#6B7280'),

                        TextEntry::make('max_files')
                            ->label('Numărul maxim de fișiere'),

                        IconEntry::make('is_active')
                            ->label('Activ')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                    ])
                    ->columns(2),

                Section::make('Fișiere Atașate')
                    ->schema([
                        RepeatableEntry::make('files')
                            ->label('')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nume fișier')
                                    ->weight('medium'),

                                TextEntry::make('size')
                                    ->label('Dimensiune')
                                    ->formatStateUsing(fn ($state) => $state ? $this->formatBytes($state) : 'N/A'),

                                TextEntry::make('type')
                                    ->label('Tip')
                                    ->badge(),

                                TextEntry::make('uploaded_at')
                                    ->label('Încărcat la')
                                    ->dateTime('d.m.Y H:i'),
                            ])
                            ->columns(4),
                    ])
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record->files && count($record->files) > 0),

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

    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
