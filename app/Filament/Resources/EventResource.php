<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Wave\Category;
use Wave\Event;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'phosphor-trophy-duotone';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Management Conținut';

    protected static ?string $navigationLabel = 'Competiții';

    protected static ?string $modelLabel = 'Competiție';

    protected static ?string $pluralModelLabel = 'Competiții';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalii Principale')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Nume Eveniment')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(191),
                        Forms\Components\RichEditor::make('body')
                            ->label('Descriere')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Scurtă Descriere (opțional)')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagine de Prezentare')
                            ->image()
                            ->disk('public')
                            ->directory('events')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => (string) str()->uuid() . '.' . $file->getClientOriginalExtension()),
                    ])->columns(2),

                Forms\Components\Section::make('Detalii Eveniment')
                    ->schema([
                        Forms\Components\TextInput::make('location')
                            ->label('Locație')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('caniva_link')
                            ->label('Link Înscriere Caniva')
                            ->url()
                            ->maxLength(191),
                        Forms\Components\TagsInput::make('disciplines')
                            ->label('Discipline (separat prin virgulă sau Enter)'),
                        Forms\Components\TagsInput::make('judges')
                            ->label('Arbitri (separat prin virgulă sau Enter)'),
                    ])->columns(2),

                Forms\Components\Section::make('Date Cheie')
                    ->schema([
                        Forms\Components\DatePicker::make('event_start_date')
                            ->label('Data de Început a Evenimentului')
                            ->native(false),
                        Forms\Components\DatePicker::make('booking_start_date')
                            ->label('Început Înscrieri')
                            ->native(false),
                        Forms\Components\DatePicker::make('booking_end_date')
                            ->label('Sfârșit Înscrieri')
                            ->native(false),
                    ])->columns(3),


                Forms\Components\Section::make('Administrativ & SEO')
                    ->schema([
                        Forms\Components\Select::make('author_id')
                            ->label('Autor')
                            ->options(
                                User::all()
                                    ->mapWithKeys(fn ($user) => [
                                        $user->id => $user->name
                                            ?? $user->username
                                            ?? $user->email,
                                    ])
                                    ->toArray()
                            )
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('categories')
                            ->label('Categorii')
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'DRAFT' => 'Ciornă',
                                'PUBLISHED' => 'Publicat',
                                'ARCHIVED' => 'Arhivat',
                            ])->default('DRAFT'),
                        Forms\Components\Toggle::make('featured')
                            ->label('Competiție Recomandată')
                            ->required(),
                        Forms\Components\TextInput::make('seo_title')
                            ->label('Titlu SEO')
                            ->maxLength(191),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descriere')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('meta_keywords')
                            ->label('Meta Cuvinte Cheie')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Nume Eveniment')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagine'),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Categorii')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_start_date')
                    ->label('Data Eveniment')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DRAFT' => 'gray',
                        'PUBLISHED' => 'success',
                        'ARCHIVED' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('featured')
                    ->label('Recomandat')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima Modificare')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
