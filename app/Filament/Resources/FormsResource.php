<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormsResource\Pages;
use App\Models\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FormsResource extends Resource
{
    protected static ?string $model = Forms::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Formulare';

    protected static ?string $modelLabel = 'Formular';

    protected static ?string $pluralModelLabel = 'Formulare';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nume')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->maxLength(191),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(191),

                Repeater::make('fields')
                    ->label('Câmpuri')
                    ->schema([
                        TextInput::make('label')
                            ->label('Etichetă')
                            ->required(),
                        Select::make('type')
                            ->label('Tip')
                            ->options(config('forms.types'))
                            ->required(),
                        TextInput::make('rules')
                            ->label('Reguli'),
                        // Repeater::make('options')
                        //         ->schema([
                        //             TextInput::make('option')->required(),
                        //         ])->columnSpanFull()
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Activ')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nume'),
                TextColumn::make('slug')
                    ->label('Slug'),
                ToggleColumn::make('is_active')
                    ->label('Activ'),
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
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForms::route('/create'),
            'edit' => Pages\EditForms::route('/{record}/edit'),
        ];
    }
}
