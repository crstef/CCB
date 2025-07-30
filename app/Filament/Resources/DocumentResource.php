<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
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

                        Select::make('category')
                            ->label('Categorie')
                            ->options(Document::getCategories())
                            ->required()
                            ->default('General'),

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
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxFiles(fn ($get) => $get('max_files') ?: 1)
                            ->directory('documents')
                            ->visibility('public')
                            ->previewable(false)
                            ->downloadable()
                            ->helperText('Acceptă doar fișiere PDF și Word (.doc, .docx)')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state && count($state) > ($get('max_files') ?: 1)) {
                                    // Remove excess files
                                    $maxFiles = $get('max_files') ?: 1;
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

                BadgeColumn::make('category')
                    ->label('Categorie')
                    ->searchable()
                    ->sortable(),

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
                SelectFilter::make('category')
                    ->label('Categorie')
                    ->options(Document::getCategories()),

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
