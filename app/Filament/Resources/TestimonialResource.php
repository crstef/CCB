<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Managementul Conținutului';

    protected static ?string $navigationLabel = 'Echipa CCB';

    protected static ?string $modelLabel = 'Membru Echipă';

    protected static ?string $pluralModelLabel = 'Echipa CCB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nume Complet')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ex: Panoiu Gabriel')
                    ->helperText('Numele complet al membrului echipei.'),
                
                Forms\Components\TextInput::make('position')
                    ->label('Funcția/Poziția')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ex: Președinte CCB, Vicepreședinte CCB- responsabil mondioring')
                    ->helperText('Funcția sau poziția ocupată în cadrul CCB.'),
                
                Forms\Components\Textarea::make('description')
                    ->label('Descriere (Opțional)')
                    ->rows(3)
                    ->placeholder('O scurtă descriere despre membru, experiența sa, realizări...')
                    ->helperText('Descriere opțională despre membru și contribuția sa la CCB.'),
                
                Forms\Components\FileUpload::make('image')
                    ->label('Fotografia')
                    ->image()
                    ->directory('team-members')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Încarcă fotografia membrului echipei (max 2MB). Formatul recomandat: 300x300px, circular.')
                    ->imageEditor()
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeMode('cover')
                    ->required(),
                
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordinea de afișare')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Numărul ordinii de afișare (1, 2, 3...). Membrii cu numere mai mici apar primii.'),
                
                Forms\Components\Toggle::make('is_active')
                    ->label('Activ')
                    ->default(true)
                    ->helperText('Bifează pentru a afișa membrul pe site. Debifează pentru a-l ascunde temporar.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->size(50),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nume')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('position')
                    ->label('Funcția')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Descriere')
                    ->limit(40)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
