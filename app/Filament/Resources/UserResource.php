<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'phosphor-users-duotone';

    protected static ?string $navigationLabel = 'Utilizatori';

    protected static ?string $modelLabel = 'Utilizator';

    protected static ?string $pluralModelLabel = 'Utilizatori';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nume')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('username')
                    ->label('Nume Utilizator')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\FileUpload::make('avatar')
                    ->label('Avatar')
                    ->required()
                    ->image(),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Email Verificat La'),
                Forms\Components\TextInput::make('password')
                    ->label('Parolă')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Select::make('roles')
                    ->label('Roluri')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\DateTimePicker::make('trial_ends_at')
                    ->label('Perioada de Probă se Termină La'),
                Forms\Components\TextInput::make('verification_code')
                    ->label('Cod de Verificare')
                    ->maxLength(191),
                Forms\Components\Toggle::make('verified')
                    ->label('Verificat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nume')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(url('storage/demo/default.png')),
                Tables\Columns\TextColumn::make('username')
                    ->label('Nume Utilizator')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Impersonate')
                    ->label('Impersonare')
                    ->url(fn ($record) => route('impersonate', $record))
                    ->visible(fn ($record) => auth()->user()->id !== $record->id),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
