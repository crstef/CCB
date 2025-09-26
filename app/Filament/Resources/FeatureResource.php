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

    protected static ?string $navigationGroup = 'Management Conținut';

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
                            ->label('Descriere')
                            ->rows(3),
                        
                        Forms\Components\Select::make('icon')
                            ->options(self::getIconOptions())
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

    public static function getIconOptions(): array
    {
        return [
            'heroicon-o-academic-cap' => 'Educație',
            'heroicon-o-adjustments-horizontal' => 'Setări',
            'heroicon-o-archive-box' => 'Arhivă',
            'heroicon-o-arrow-trending-up' => 'Creștere',
            'heroicon-o-beaker' => 'Cercetare',
            'heroicon-o-bolt' => 'Energie',
            'heroicon-o-book-open' => 'Carte',
            'heroicon-o-briefcase' => 'Business',
            'heroicon-o-bug-ant' => 'Debugging',
            'heroicon-o-building-office' => 'Birou',
            'heroicon-o-calculator' => 'Calculator',
            'heroicon-o-calendar-days' => 'Calendar',
            'heroicon-o-camera' => 'Cameră',
            'heroicon-o-chart-bar' => 'Grafic',
            'heroicon-o-chart-pie' => 'Statistici',
            'heroicon-o-chat-bubble-left-right' => 'Chat',
            'heroicon-o-check-circle' => 'Succes',
            'heroicon-o-clipboard' => 'Clipboard',
            'heroicon-o-clock' => 'Ceas',
            'heroicon-o-cloud' => 'Cloud',
            'heroicon-o-code-bracket' => 'Cod',
            'heroicon-o-cog-6-tooth' => 'Configurare',
            'heroicon-o-command-line' => 'Terminal',
            'heroicon-o-computer-desktop' => 'Desktop',
            'heroicon-o-cpu-chip' => 'Procesor',
            'heroicon-o-credit-card' => 'Plată',
            'heroicon-o-cube' => 'Cub',
            'heroicon-o-currency-dollar' => 'Dolari',
            'heroicon-o-cursor-arrow-rays' => 'Click',
            'heroicon-o-document' => 'Document',
            'heroicon-o-document-text' => 'Text',
            'heroicon-o-envelope' => 'Email',
            'heroicon-o-eye' => 'Vedere',
            'heroicon-o-fire' => 'Popular',
            'heroicon-o-flag' => 'Flag',
            'heroicon-o-gift' => 'Cadou',
            'heroicon-o-globe-alt' => 'Global',
            'heroicon-o-hand-raised' => 'Stop',
            'heroicon-o-heart' => 'Inimă',
            'heroicon-o-home' => 'Acasă',
            'heroicon-o-information-circle' => 'Info',
            'heroicon-o-key' => 'Cheie',
            'heroicon-o-light-bulb' => 'Idee',
            'heroicon-o-link' => 'Link',
            'heroicon-o-lock-closed' => 'Blocat',
            'heroicon-o-magnifying-glass' => 'Căutare',
            'heroicon-o-map' => 'Hartă',
            'heroicon-o-megaphone' => 'Anunț',
            'heroicon-o-microphone' => 'Microfon',
            'heroicon-o-musical-note' => 'Muzică',
            'heroicon-o-paint-brush' => 'Design',
            'heroicon-o-paper-airplane' => 'Trimitere',
            'heroicon-o-photo' => 'Poză',
            'heroicon-o-play' => 'Play',
            'heroicon-o-presentation-chart-line' => 'Prezentare',
            'heroicon-o-puzzle-piece' => 'Plugin',
            'heroicon-o-rocket-launch' => 'Lansare',
            'heroicon-o-scale' => 'Balanță',
            'heroicon-o-server' => 'Server',
            'heroicon-o-shield-check' => 'Securitate',
            'heroicon-o-shopping-cart' => 'Cumpărături',
            'heroicon-o-sparkles' => 'Sparkles',
            'heroicon-o-star' => 'Stea',
            'heroicon-o-sun' => 'Soare',
            'heroicon-o-tag' => 'Tag',
            'heroicon-o-ticket' => 'Bilet',
            'heroicon-o-trophy' => 'Trofeu',
            'heroicon-o-truck' => 'Transport',
            'heroicon-o-user' => 'Utilizator',
            'heroicon-o-user-group' => 'Grup',
            'heroicon-o-wifi' => 'WiFi',
            'heroicon-o-wrench-screwdriver' => 'Unelte',
        ];
    }
}
