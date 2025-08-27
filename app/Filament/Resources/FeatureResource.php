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

    protected static ?string $navigationGroup = 'Managementul Conținutului';

    protected static ?string $navigationLabel = 'Servicii';

    protected static ?string $modelLabel = 'Serviciu';

    protected static ?string $pluralModelLabel = 'Servicii';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Titlu'),
                        
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Descriere')
                            ->rows(3),
                        
                        Forms\Components\Select::make('icon')
                            ->options(self::getIconOptions())
                            ->required()
                            ->label('Iconiță')
                            ->searchable()
                            ->getSearchResultsUsing(function (string $search) {
                                $icons = self::getIconOptions();
                                return array_filter($icons, function($label, $value) use ($search) {
                                    return str_contains(strtolower($label), strtolower($search)) ||
                                           str_contains(strtolower($value), strtolower($search));
                                }, ARRAY_FILTER_USE_BOTH);
                            }),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagine')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '16:9', 
                                '4:3',
                            ])
                            ->disk('public')
                            ->directory('features')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Opțional: imaginea va fi folosită în loc de iconiță dacă este încărcată')
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Ordinea'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Activ'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titlu')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Descriere')
                    ->limit(60)
                    ->searchable()
                    ->wrap(),
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagine')
                    ->disk('public')
                    ->visibility('public')
                    ->size(40)
                    ->circular(),
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Iconița')
                    ->badge()
                    ->color('gray'),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordine')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Activ',
                        0 => 'Inactiv',
                    ])
                    ->placeholder('Toate statusurile'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editează'),
                Tables\Actions\DeleteAction::make()
                    ->label('Șterge'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Șterge selecțiile'),
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
