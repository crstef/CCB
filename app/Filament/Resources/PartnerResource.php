<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Parteneri';

    protected static ?string $modelLabel = 'Partner';

    protected static ?string $pluralModelLabel = 'Parteneri';

    protected static ?string $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informații Partner')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nume Partner')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Descriere')
                            ->maxLength(500)
                            ->rows(3),

                        Forms\Components\TextInput::make('website_url')
                            ->label('Website URL')
                            ->url()
                            ->required()
                            ->placeholder('https://example.com')
                            ->helperText('URL-ul complet către site-ul partenerului'),

                        Forms\Components\FileUpload::make('logo_path')
                            ->label('Logo Partner')
                            ->image()
                            ->imageEditor()
                            ->directory('partners/logos')
                            ->disk('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->helperText('Încarcă logo-ul partenerului (max 2MB)'),

                        Forms\Components\TextInput::make('order')
                            ->label('Ordinea afișării')
                            ->numeric()
                            ->default(0)
                            ->helperText('Numărul ordinii pentru sortarea partenerilor'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Activ')
                            ->default(true)
                            ->helperText('Activează sau dezactivează afișarea partenerului'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->size(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nume Partner')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('website_url')
                    ->label('Website')
                    ->url(fn (Partner $record): string => $record->website_url)
                    ->openUrlInNewTab()
                    ->limit(30),

                Tables\Columns\TextColumn::make('order')
                    ->label('Ordine')
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Activ')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizat la')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Toți partenerii')
                    ->trueLabel('Doar activi')
                    ->falseLabel('Doar inactivi'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'view' => Pages\ViewPartner::route('/{record}'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}