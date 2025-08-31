<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Documente';

    protected static ?string $modelLabel = 'Document';

    protected static ?string $pluralModelLabel = 'Documente';

    protected static ?string $navigationGroup = 'Management Conținut';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informații Document')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titlu')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descriere')
                            ->rows(3)
                            ->columnSpanFull(),

                        Select::make('document_category_id')
                            ->label('Categorie')
                            ->relationship('category', 'name')
                            ->options(DocumentCategory::getActiveOptions())
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nume Categorie')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Descriere'),
                                ColorPicker::make('color')
                                    ->label('Culoare')
                                    ->default('#3B82F6'),
                            ])
                            ->helperText('Selectează o categorie existentă sau creează una nouă'),

                        TextInput::make('max_files')
                            ->label('Numărul maxim de fișiere')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->maxValue(10)
                            ->helperText('Specificați câte fișiere pot fi atașate la acest document'),

                        Toggle::make('is_active')
                            ->label('Activ')
                            ->default(true)
                            ->helperText('Documentele inactive nu vor fi afișate în frontend'),
                    ])
                    ->columns(2),

                Section::make('Fișiere Atașate')
                    ->schema([
                        FileUpload::make('files')
                            ->label('Fișiere')
                            ->multiple()
                            ->reorderable()
                            ->acceptedFileTypes([
                                'application/pdf', 
                                'application/msword', 
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                'text/plain',
                                'image/jpeg',
                                'image/png'
                            ])
                            ->maxFiles(fn (callable $get): int => (int) $get('max_files') ?: 1)
                            ->directory('documents')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->previewable(true)
                            ->downloadable()
                            ->openable()
                            ->helperText(fn (callable $get): string => 
                                'Poți atașa până la ' . ($get('max_files') ?: 1) . ' fișiere. Acceptă PDF, Word, Excel, PowerPoint, text și imagini.'
                            )
                            ->live() // În loc de reactive() pentru Filament v3
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $maxFiles = (int) $get('max_files') ?: 1;
                                if ($state && is_array($state) && count($state) > $maxFiles) {
                                    // Păstrează doar primele X fișiere conform limitei
                                    $set('files', array_slice($state, 0, $maxFiles));
                                }
                            }),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titlu')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('category.name')
                    ->label('Categorie')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) => $record->category?->color ?? '#6B7280'),

                TextColumn::make('max_files')
                    ->label('Max. Fișiere')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('files_count')
                    ->label('Fișiere Atașate')
                    ->getStateUsing(fn ($record) => $record->getUploadedFilesCount())
                    ->badge()
                    ->color(fn ($state, $record) => $state >= $record->max_files ? 'success' : 'warning')
                    ->alignCenter(),

                BooleanColumn::make('is_active')
                    ->label('Activ')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Actualizat la')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('document_category_id')
                    ->label('Categorie')
                    ->relationship('category', 'name')
                    ->preload(),

                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Toate')
                    ->trueLabel('Activ')
                    ->falseLabel('Inactiv'),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'view' => Pages\ViewDocument::route('/{record}'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
