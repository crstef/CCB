<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'phosphor-address-book-duotone';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Administrare';

    protected static ?string $navigationLabel = 'Roluri';

    protected static ?string $modelLabel = 'Rol';

    protected static ?string $pluralModelLabel = 'Roluri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nume')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('guard_name')
                    ->label('Guard')
                    ->required()
                    ->maxLength(191)
                    ->default('web'),
                Forms\Components\TextInput::make('description')
                    ->label('Descriere')
                    ->required()
                    ->maxLength(191)
                    ->columnSpanFull(),
                Forms\Components\Select::make('permissions')
                    ->label('Permisiuni')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload()
                    ->searchable()
                    ->columnSpanFull()
                    ->helperText('Selectează permisiunile pe care le are acest rol'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nume')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descriere')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Nr. Permisiuni')
                    ->counts('permissions')
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions.name')
                    ->label('Permisiuni')
                    ->badge()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Guard')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizat la')
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
