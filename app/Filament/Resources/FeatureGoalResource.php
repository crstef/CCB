<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureGoalResource\Pages;
use App\Models\FeatureGoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureGoalResource extends Resource
{
    protected static ?string $model = FeatureGoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Management Conținut';

    protected static ?string $navigationLabel = 'Obiective & Info';

    protected static ?string $modelLabel = 'Obiectiv';

    protected static ?string $pluralModelLabel = 'Obiective & Info';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titlu')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Introdu titlul obiectivului...')
                    ->helperText('Numele obiectivului care va apărea pe prima pagină.'),
                
                Forms\Components\Textarea::make('description')
                    ->label('Descriere')
                    ->required()
                    ->rows(3)
                    ->placeholder('Introdu descrierea obiectivului...')
                    ->helperText('Descrie pe scurt acest obiectiv sau informație.'),
                
                Forms\Components\Select::make('icon')
                    ->label('Iconița')
                    ->required()
                    ->options([
                        // Obiective și aspirații
                        'star' => 'Star (Obiectiv principal)',
                        'trophy' => 'Trophy (Realizări)',
                        'target' => 'Target (Ținte)',
                        'flag' => 'Flag (Milestone)',
                        'rocket-launch' => 'Rocket Launch (Lansare)',
                        'sparkles' => 'Sparkles (Inovație)',
                        'light-bulb' => 'Light Bulb (Idei)',
                        'fire' => 'Fire (Pasiune)',
                        
                        // Progres și dezvoltare
                        'chart-bar-square' => 'Chart Bar Square (Progres)',
                        'arrow-trending-up' => 'Arrow Trending Up (Creștere)',
                        'presentation-chart-line' => 'Presentation Chart Line (Analiză)',
                        'academic-cap' => 'Academic Cap (Dezvoltare)',
                        'cog-6-tooth' => 'Cog (Îmbunătățiri)',
                        'wrench-screwdriver' => 'Wrench Screwdriver (Dezvoltare)',
                        
                        // Comunitate și echipă
                        'users' => 'Users (Comunitate)',
                        'user-group' => 'User Group (Echipă)',
                        'heart' => 'Heart (Pasiune)',
                        'hand-raised' => 'Hand Raised (Voluntariat)',
                        'chat-bubble-left-right' => 'Chat (Comunicare)',
                        'megaphone' => 'Megaphone (Anunțuri)',
                        
                        // Siguranță și calitate
                        'shield-check' => 'Shield Check (Siguranță)',
                        'check-badge' => 'Check Badge (Calitate)',
                        'star-filled' => 'Star Filled (Premium)',
                        'award' => 'Award (Recunoaștere)',
                        
                        // Tehnologie și inovație
                        'cpu-chip' => 'CPU Chip (Tehnologie)',
                        'device-phone-mobile' => 'Device Phone Mobile (Mobil)',
                        'globe-alt' => 'Globe Alt (Global)',
                        'wifi' => 'WiFi (Conectivitate)',
                        
                        // Timp și planificare
                        'calendar' => 'Calendar (Planificare)',
                        'clock' => 'Clock (Timp)',
                        'calendar-days' => 'Calendar Days (Evenimente)',
                        
                        // Alte categorii utile
                        'building-office' => 'Building Office (Organizație)',
                        'map' => 'Map (Localizare)',
                        'camera' => 'Camera (Media)',
                        'document' => 'Document (Informații)',
                        'envelope' => 'Envelope (Contact)',
                        'phone' => 'Phone (Comunicare)',
                    ])
                    ->searchable()
                    ->placeholder('Selectează o iconiță...')
                    ->helperText('Iconița care va apărea alături de obiectiv.'),
                
                Forms\Components\FileUpload::make('image')
                    ->label('Imagine')
                    ->image()
                    ->directory('feature-goals')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Opțional: Încarcă o imagine reprezentativă (max 2MB). Formatul recomandat: 400x300px.')
                    ->imageEditor()
                    ->imageCropAspectRatio('4:3'),
                
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordinea de afișare')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Numărul ordinii de afișare (1, 2, 3...). Obiectivele cu numere mai mici apar primele.'),
                
                Forms\Components\Toggle::make('is_active')
                    ->label('Activ')
                    ->default(true)
                    ->helperText('Bifează pentru a afișa obiectivul pe prima pagină. Debifează pentru a-l ascunde temporar.'),
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
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Iconița')
                    ->badge()
                    ->color('gray'),
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagine')
                    ->size(40)
                    ->defaultImageUrl('/images/placeholder.png'),
                
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
            'index' => Pages\ListFeatureGoals::route('/'),
            'create' => Pages\CreateFeatureGoal::route('/create'),
            'edit' => Pages\EditFeatureGoal::route('/{record}/edit'),
        ];
    }
}
