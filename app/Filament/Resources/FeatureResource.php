<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Features';

    protected static ?string $modelLabel = 'Feature';

    protected static ?string $pluralModelLabel = 'Features';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titlu')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('description')
                    ->label('Descriere')
                    ->required()
                    ->rows(3),
                
                Forms\Components\Select::make('icon')
                    ->label('Iconita')
                    ->required()
                    ->options([
                        'users-three' => 'Users Three (Management utilizatori)',
                        'shield-check' => 'Shield Check (Securitate)',
                        'puzzle-piece' => 'Puzzle Piece (Integrări)',
                        'chart-bar' => 'Chart Bar (Analitice)',
                        'paint-bucket' => 'Paint Bucket (Teme)',
                        'gear-fine' => 'Gear Fine (Configurare)',
                        'lifebuoy' => 'Lifebuoy (Suport)',
                        'images-square' => 'Images Square (Management fișiere)',
                        'star' => 'Star (Premium)',
                        'lightning-bolt' => 'Lightning Bolt (Viteză)',
                        'heart' => 'Heart (Favorite)',
                        'bell' => 'Bell (Notificări)',
                        'calendar' => 'Calendar (Evenimente)',
                        'chat-bubble-left-right' => 'Chat (Comunicare)',
                        'academic-cap' => 'Academic Cap (Educație)',
                    ])
                    ->searchable(),
                
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordinea sortării')
                    ->numeric()
                    ->default(0)
                    ->required(),
                
                Forms\Components\Toggle::make('is_active')
                    ->label('Activ')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titlu')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Descriere')
                    ->limit(50)
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Iconita')
                    ->badge(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordine')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activ')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Activ',
                        0 => 'Inactiv',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
