<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use App\Mail\ContactReply;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Mesaje Contact';

    protected static ?string $modelLabel = 'Mesaj Contact';

    protected static ?string $pluralModelLabel = 'Mesaje Contact';

    protected static ?string $navigationGroup = 'Comunicare';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::new()->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $newCount = static::getModel()::where('status', Contact::STATUS_NEW)->count();
        return $newCount > 0 ? 'danger' : 'gray';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informații Contact')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('Prenume')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('last_name')
                                    ->label('Nume')
                                    ->required()
                                    ->maxLength(100),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('Telefon')
                                    ->tel()
                                    ->maxLength(20),
                            ]),
                        TextInput::make('subject')
                            ->label('Subiect')
                            ->required()
                            ->maxLength(200)
                            ->columnSpanFull(),
                        Textarea::make('message')
                            ->label('Mesaj')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Status și Management')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(Contact::getStatuses())
                            ->required()
                            ->default(Contact::STATUS_NEW),
                        Textarea::make('notes')
                            ->label('Note interne')
                            ->rows(3)
                            ->helperText('Note pentru uz intern - nu sunt vizibile clientului'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Contact::STATUS_NEW => 'danger',
                        Contact::STATUS_READ => 'warning',
                        Contact::STATUS_REPLIED => 'success',
                        Contact::STATUS_CLOSED => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => Contact::getStatuses()[$state] ?? $state)
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Nume complet')
                    ->searchable(['first_name', 'last_name'])
                    ->weight(FontWeight::Medium)
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copiat!')
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Telefon copiat!')
                    ->icon('heroicon-m-phone')
                    ->placeholder('—'),
                TextColumn::make('subject')
                    ->label('Subiect')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),
                TextColumn::make('created_at')
                    ->label('Primit la')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('read_at')
                    ->label('Citit la')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('Necitit')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Contact::getStatuses()),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Action::make('mark_as_read')
                    ->label('Marchează ca citit')
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->visible(fn (Contact $record): bool => $record->status === Contact::STATUS_NEW)
                    ->action(function (Contact $record): void {
                        $record->markAsRead();
                        Notification::make()
                            ->title('Mesaj marcat ca citit')
                            ->success()
                            ->send();
                    }),
                Action::make('mark_as_replied')
                    ->label('Marchează ca răspuns')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->visible(fn (Contact $record): bool => in_array($record->status, [Contact::STATUS_NEW, Contact::STATUS_READ]))
                    ->action(function (Contact $record): void {
                        $record->markAsReplied();
                        Notification::make()
                            ->title('Mesaj marcat ca răspuns')
                            ->success()
                            ->send();
                    }),
                Action::make('reply')
                    ->label('Răspunde')
                    ->icon('heroicon-o-envelope')
                    ->color('primary')
                    ->form([
                        Forms\Components\Section::make('Mesajul original')
                            ->schema([
                                Forms\Components\Placeholder::make('original_message_info')
                                    ->label('')
                                    ->content(function (Contact $record): string {
                                        return "**De la:** {$record->full_name} ({$record->email})\n**Subiect:** {$record->subject}\n**Data:** {$record->created_at->format('d.m.Y la H:i')}\n\n**Mesaj:**\n{$record->message}";
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->collapsed(false),
                        Forms\Components\Section::make('Răspunsul dumneavoastră')
                            ->schema([
                                Forms\Components\TextInput::make('reply_subject')
                                    ->label('Subiect răspuns')
                                    ->default(fn (Contact $record): string => 'Re: ' . $record->subject)
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('reply_message')
                                    ->label('Mesajul dumneavoastră')
                                    ->required()
                                    ->rows(8)
                                    ->placeholder('Scrieți răspunsul aici...')
                                    ->helperText('Mesajul original va fi inclus automat în email.'),
                            ]),
                    ])
                    ->action(function (Contact $record, array $data): void {
                        try {
                            // Trimite email-ul de răspuns
                            Mail::send(new ContactReply(
                                $record, 
                                $data['reply_message'], 
                                $data['reply_subject']
                            ));
                            
                            // Marchează ca răspuns
                            $record->markAsReplied();
                            
                            Notification::make()
                                ->title('Răspuns trimis cu succes!')
                                ->body('Email-ul a fost trimis către ' . $record->email)
                                ->success()
                                ->send();
                                
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Eroare la trimiterea răspunsului')
                                ->body('Nu s-a putut trimite email-ul: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->modalHeading('Răspunde la mesaj')
                    ->modalDescription(fn (Contact $record): string => 
                        'Răspundeți la mesajul de la ' . $record->full_name . ' (' . $record->email . ')'
                    )
                    ->modalSubmitActionLabel('Trimite răspunsul')
                    ->modalWidth('lg'),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Detalii Contact')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('full_name')
                                    ->label('Nume complet')
                                    ->weight(FontWeight::Bold),
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        Contact::STATUS_NEW => 'danger',
                                        Contact::STATUS_READ => 'warning',
                                        Contact::STATUS_REPLIED => 'success',
                                        Contact::STATUS_CLOSED => 'gray',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => Contact::getStatuses()[$state] ?? $state),
                            ]),
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('email')
                                    ->label('Email')
                                    ->copyable()
                                    ->icon('heroicon-m-envelope'),
                                Infolists\Components\TextEntry::make('phone')
                                    ->label('Telefon')
                                    ->copyable()
                                    ->icon('heroicon-m-phone')
                                    ->placeholder('—'),
                            ]),
                        Infolists\Components\TextEntry::make('subject')
                            ->label('Subiect')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('message')
                            ->label('Mesaj')
                            ->columnSpanFull()
                            ->prose(),
                    ]),
                Infolists\Components\Section::make('Informații Tehnice')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Primit la')
                                    ->dateTime('d.m.Y H:i:s'),
                                Infolists\Components\TextEntry::make('read_at')
                                    ->label('Citit la')
                                    ->dateTime('d.m.Y H:i:s')
                                    ->placeholder('Necitit'),
                            ]),
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('ip_address')
                                    ->label('Adresa IP')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('replied_at')
                                    ->label('Răspuns la')
                                    ->dateTime('d.m.Y H:i:s')
                                    ->placeholder('Fără răspuns'),
                            ]),
                        Infolists\Components\TextEntry::make('user_agent')
                            ->label('Browser')
                            ->columnSpanFull()
                            ->placeholder('—'),
                    ])
                    ->collapsible(),
                Infolists\Components\Section::make('Note Interne')
                    ->schema([
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Note')
                            ->prose()
                            ->placeholder('Fără note')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
