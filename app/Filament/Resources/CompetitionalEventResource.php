<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompetitionalEventResource\Pages;
use App\Models\CompetitionalEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CompetitionalEventResource extends Resource
{
    protected static ?string $model = CompetitionalEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Calendar Competițional';

    protected static ?string $pluralLabel = 'Evenimente Competiționale';

    protected static ?string $navigationGroup = 'Competiții';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informații Eveniment')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('date_start')
                                    ->label('Data începerii')
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->native(false),
                                    
                                Forms\Components\DatePicker::make('date_end')
                                    ->label('Data încheierii')
                                    ->displayFormat('d/m/Y')
                                    ->native(false)
                                    ->helperText('Lasă gol pentru evenimente dintr-o singură zi'),
                            ]),
                            
                        Forms\Components\TextInput::make('nume_competitie')
                            ->label('Nume Competiție')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: IGP, Mondioring, Expozitie Club'),
                            
                        Forms\Components\TextInput::make('locatie')
                            ->label('Locație')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: Baile 1 Mai, jud Bihor'),
                    ]),
                    
                Forms\Components\Section::make('Detalii Suplimentare')
                    ->schema([
                        Forms\Components\Textarea::make('descriere')
                            ->label('Descriere')
                            ->placeholder('Ex: Etapa de calificare FMBB 2026, Competitie de Club')
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('colaborare')
                            ->label('Colaborare')
                            ->placeholder('Ex: Colaborare cu CNCG, Colaborare cu ACMR')
                            ->maxLength(255),
                    ]),
                    
                Forms\Components\Section::make('Setări')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Activ')
                                    ->default(true)
                                    ->helperText('Evenimentele inactive nu vor fi afișate pe site'),
                                    
                                Forms\Components\TextInput::make('order')
                                    ->label('Ordine')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Pentru sortare manuală (opțional)'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_start')
                    ->label('Data început')
                    ->date('d M Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('date_end')
                    ->label('Data sfârșit')
                    ->date('d M Y')
                    ->placeholder('O singură zi')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('nume_competitie')
                    ->label('Competiție')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('locatie')
                    ->label('Locație')
                    ->searchable()
                    ->limit(30),
                    
                Tables\Columns\TextColumn::make('descriere')
                    ->label('Descriere')
                    ->limit(40)
                    ->placeholder('Fără descriere'),
                    
                Tables\Columns\TextColumn::make('colaborare')
                    ->label('Colaborare')
                    ->limit(20)
                    ->placeholder('-'),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activ')
                    ->boolean()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('order')
                    ->label('Ordine')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Toate')
                    ->trueLabel('Doar active')
                    ->falseLabel('Doar inactive'),
                    
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('De la data'),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Până la data'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_start', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_start', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activează')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Dezactivează')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('date_start', 'asc');
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
            'index' => Pages\ListCompetitionalEvents::route('/'),
            'create' => Pages\CreateCompetitionalEvent::route('/create'),
            'view' => Pages\ViewCompetitionalEvent::route('/{record}'),
            'edit' => Pages\EditCompetitionalEvent::route('/{record}/edit'),
        ];
    }
}