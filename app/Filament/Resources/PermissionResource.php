<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'phosphor-shield-check-duotone';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Administrare';

    protected static ?string $navigationLabel = 'Permisiuni';

    protected static ?string $modelLabel = 'Permisiune';

    protected static ?string $pluralModelLabel = 'Permisiuni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nume')
                    ->required()
                    ->maxLength(191)
                    ->helperText('Ex: edit-posts, delete-users, view-admin'),
                Forms\Components\TextInput::make('guard_name')
                    ->label('Guard')
                    ->required()
                    ->maxLength(191)
                    ->default('web'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nume')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->label('Guard')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Utilizat în Roluri')
                    ->badge()
                    ->limit(3)
                    ->limitedRemainingText(),
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
