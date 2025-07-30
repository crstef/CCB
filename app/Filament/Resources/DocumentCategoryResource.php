<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentCategoryResource\Pages;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class DocumentCategoryResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Categorii Documente';

    protected static ?string $modelLabel = 'Categorie Document';

    protected static ?string $pluralModelLabel = 'Categorii Documente';

    protected static ?string $navigationGroup = 'Management Conținut';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informații Categorie')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nume Categorie')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->live(onBlur: true)
                            ->helperText('Numele categoriei (va fi generat automat un slug)')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descriere')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Descriere opțională pentru categorie'),

                        ColorPicker::make('color')
                            ->label('Culoare')
                            ->default('#3B82F6')
                            ->helperText('Culoarea care va fi folosită pentru badge-ul categoriei'),

                        TextInput::make('sort_order')
                            ->label('Ordine Sortare')
                            ->numeric()
                            ->default(0)
                            ->helperText('Numărul pentru sortarea categoriilor (0 = primul)'),

                        Toggle::make('is_active')
                            ->label('Activ')
                            ->default(true)
                            ->helperText('Categoriile inactive nu pot fi selectate la documente'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nume')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable()
                    ->color('gray'),

                ColorColumn::make('color')
                    ->label('Culoare')
                    ->sortable(),

                TextColumn::make('documents_count')
                    ->label('Nr. Documente')
                    ->counts('documents')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Ordine')
                    ->sortable()
                    ->alignCenter(),

                BooleanColumn::make('is_active')
                    ->label('Activ')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Toate')
                    ->trueLabel('Activ')
                    ->falseLabel('Inactiv'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (DocumentCategory $record) {
                        // Check if category has documents
                        if ($record->documents()->count() > 0) {
                            throw new \Exception('Nu puteți șterge o categorie care are documente asociate.');
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->documents()->count() > 0) {
                                    throw new \Exception('Nu puteți șterge categorii care au documente asociate.');
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
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
            'index' => Pages\ListDocumentCategories::route('/'),
            'create' => Pages\CreateDocumentCategory::route('/create'),
            'view' => Pages\ViewDocumentCategory::route('/{record}'),
            'edit' => Pages\EditDocumentCategory::route('/{record}/edit'),
        ];
    }
}
