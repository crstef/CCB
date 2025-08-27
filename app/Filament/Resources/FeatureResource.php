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
                Forms\Components\TextInput::make('title')
                    ->label('Titlu')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Introdu titlul serviciului...')
                    ->helperText('Numele serviciului care va apărea pe site.'),
                
                Forms\Components\Textarea::make('description')
                    ->label('Descriere')
                    ->required()
                    ->rows(3)
                    ->placeholder('Introdu descrierea serviciului...')
                    ->helperText('Descrie pe scurt beneficiile și funcționalitatea acestui serviciu.'),
                
                Forms\Components\Select::make('icon')
                    ->label('Iconita')
                    ->required()
                    ->options([
                        // Management și administrare
                        'users-three' => 'Users Three (Management utilizatori)',
                        'user-group' => 'User Group (Echipe)',
                        'identification' => 'Identification (Identificare)',
                        'key' => 'Key (Acces/Permisiuni)',
                        'shield-check' => 'Shield Check (Securitate)',
                        'lock-closed' => 'Lock Closed (Protecție)',
                        'finger-print' => 'Finger Print (Biometrie)',
                        
                        // Funcționalități și instrumente
                        'puzzle-piece' => 'Puzzle Piece (Integrări)',
                        'cog-6-tooth' => 'Cog (Configurări)',
                        'gear-fine' => 'Gear Fine (Setări avansate)',
                        'wrench-screwdriver' => 'Wrench Screwdriver (Instrumente)',
                        'command-line' => 'Command Line (Terminal)',
                        'cpu-chip' => 'CPU Chip (Procesare)',
                        
                        // Analitice și rapoarte
                        'chart-bar' => 'Chart Bar (Statistici coloane)',
                        'chart-pie' => 'Chart Pie (Statistici circ)',
                        'presentation-chart-line' => 'Presentation Chart Line (Prezentare grafice)',
                        'calculator' => 'Calculator (Calcule)',
                        'document-chart-bar' => 'Document Chart Bar (Rapoarte)',
                        'table-cells' => 'Table Cells (Tabele)',
                        
                        // Design și interfață
                        'paint-bucket' => 'Paint Bucket (Teme/Culori)',
                        'swatch' => 'Swatch (Paletă culori)',
                        'photo' => 'Photo (Imagini)',
                        'camera' => 'Camera (Fotografie)',
                        'film' => 'Film (Video)',
                        'musical-note' => 'Musical Note (Audio)',
                        
                        // Fișiere și stocare
                        'images-square' => 'Images Square (Galerie imagini)',
                        'folder' => 'Folder (Directoare)',
                        'document' => 'Document (Documente)',
                        'archive-box' => 'Archive Box (Arhivă)',
                        'cloud-arrow-up' => 'Cloud Arrow Up (Upload cloud)',
                        'server' => 'Server (Server/Stocare)',
                        
                        // Comunicare și suport
                        'lifebuoy' => 'Lifebuoy (Ajutor/Suport)',
                        'chat-bubble-left-right' => 'Chat (Conversații)',
                        'phone' => 'Phone (Telefon)',
                        'envelope' => 'Envelope (Email)',
                        'megaphone' => 'Megaphone (Anunțuri)',
                        'bell' => 'Bell (Notificări)',
                        
                        // Business și e-commerce
                        'banknotes' => 'Banknotes (Plăți)',
                        'credit-card' => 'Credit Card (Card)',
                        'shopping-cart' => 'Shopping Cart (Coș cumpărături)',
                        'building-storefront' => 'Building Storefront (Magazin)',
                        'currency-dollar' => 'Currency Dollar (Valută)',
                        
                        // Timp și planificare
                        'calendar' => 'Calendar (Calendar)',
                        'clock' => 'Clock (Ceas)',
                        'calendar-days' => 'Calendar Days (Zile)',
                        
                        // Acțiuni și stări
                        'star' => 'Star (Favorite/Premium)',
                        'heart' => 'Heart (Apreciere)',
                        'lightning-bolt' => 'Lightning Bolt (Viteză)',
                        'rocket-launch' => 'Rocket Launch (Lansare)',
                        'fire' => 'Fire (Popular/Trending)',
                        'sparkles' => 'Sparkles (Nou/Special)',
                        
                        // Educație și învățare
                        'academic-cap' => 'Academic Cap (Educație)',
                        'book-open' => 'Book Open (Lecturi)',
                        'light-bulb' => 'Light Bulb (Idei)',
                        'beaker' => 'Beaker (Cercetare)',
                        
                        // Navigare și căutare
                        'magnifying-glass' => 'Magnifying Glass (Căutare)',
                        'map' => 'Map (Hartă)',
                        'globe-alt' => 'Globe Alt (Glob/Internațional)',
                        'compass' => 'Compass (Busola)',
                        
                        // Sănătate și fitness
                        'heart-pulse' => 'Heart Pulse (Sănătate)',
                        'shield-plus' => 'Shield Plus (Protecție medicală)',
                        
                        // Social și comunitate
                        'hand-raised' => 'Hand Raised (Voluntariat)',
                        'users' => 'Users (Comunitate)',
                        'trophy' => 'Trophy (Premii)',
                        'gift' => 'Gift (Cadouri)',
                    ])
                    ->searchable()
                    ->placeholder('Selectează o iconiță...')
                    ->helperText('Iconițele folosesc biblioteca Phosphor. Poți căuta după nume sau funcționalitate.'),
                
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordinea de afișare')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Numărul ordinii de afișare (1, 2, 3...). Serviciile cu numere mai mici apar primele.'),
                
                Forms\Components\Toggle::make('is_active')
                    ->label('Activ')
                    ->default(true)
                    ->helperText('Bifează pentru a afișa serviciul pe site. Debifează pentru a-l ascunde temporar.'),
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
