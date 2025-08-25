<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * MediaResource - Filament Resource for Media Management
 * 
 * Comprehensive admin interface for managing photos and videos
 * in the media gallery system. Includes file upload, metadata
 * management, categorization, and bulk operations.
 * 
 * @package App\Filament\Resources
 * @author Wave Framework  
 * @version 1.0.0
 */
class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Galerie Media';

    protected static ?string $modelLabel = 'Element Media';

    protected static ?string $pluralModelLabel = 'Elemente Media';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Conținut';

    /**
     * Define the form schema for creating/editing media items
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Încărcare Media')
                    ->description('Încărcați fișierul foto sau video, sau furnizați un URL YouTube pentru video-uri')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Fișier Media')
                            ->disk('public')
                            ->directory('gallery')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                // Image formats
                                'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 
                                'image/webp', 'image/svg+xml', 'image/bmp',
                                // Video formats  
                                'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime',
                                'video/x-msvideo', 'video/x-ms-wmv'
                            ])
                            ->maxSize(50000) // 50MB max
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio(null)
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state instanceof TemporaryUploadedFile) {
                                    // Auto-fill fields based on uploaded file
                                    $set('file_name', $state->getClientOriginalName());
                                    $set('file_size', $state->getSize());
                                    $set('mime_type', $state->getMimeType());
                                    
                                    // Auto-detect media type
                                    $mediaType = str_starts_with($state->getMimeType(), 'image/') ? 'image' : 'video';
                                    $set('media_type', $mediaType);
                                    $set('video_source', 'local');
                                    
                                    // Set default title from filename if empty
                                    $fileName = pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME);
                                    $set('title', ucwords(str_replace(['_', '-'], ' ', $fileName)));
                                    
                                    // Clear YouTube URL when file is uploaded
                                    $set('youtube_url', null);
                                    $set('youtube_id', null);
                                }
                            })
                            ->visible(fn (Forms\Get $get) => $get('video_source') !== 'youtube')
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('youtube_url')
                            ->label('URL YouTube (alternativă la încărcarea fișierului)')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('Pentru video-uri YouTube, folosește acest câmp în loc de upload. Se va seta automat tipul media pe video.')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    // Auto-set media type to video when YouTube URL is provided
                                    $set('media_type', 'video');
                                    $set('video_source', 'youtube');
                                    
                                    // Extract YouTube ID
                                    $youtubeId = Media::extractYouTubeId($state);
                                    $set('youtube_id', $youtubeId);
                                    $set('mime_type', 'video/youtube');
                                    
                                    // Clear file fields for YouTube videos
                                    $set('file_path', null);
                                    $set('file_name', null);
                                    $set('file_size', null);
                                } else {
                                    // Reset when YouTube URL is cleared
                                    $set('youtube_id', null);
                                    $set('video_source', 'local');
                                }
                            })
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Informații Media')
                    ->description('Adăugați titlu, descriere și categorizare')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titlu')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Introduceți un titlu descriptiv')
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('description')
                            ->label('Descriere')
                            ->placeholder('Descrieți ce arată acest media...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('media_type')
                            ->label('Tip Media')
                            ->options(Media::MEDIA_TYPES)
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('video_category')
                            ->label('Categorie Video')
                            ->options(Media::VIDEO_CATEGORIES)
                            ->native(false)
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                            ->helperText('Categorie specifică pentru conținutul video'),

                        Forms\Components\Select::make('video_source')
                            ->label('Sursă Video')
                            ->options(Media::VIDEO_SOURCES)
                            ->default('local')
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state === 'youtube') {
                                    // Clear file path when switching to YouTube
                                    $set('file_path', null);
                                } else {
                                    // Clear YouTube URL when switching to local
                                    $set('youtube_url', null);
                                    $set('youtube_id', null);
                                }
                            }),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('URL YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->visible(fn (Forms\Get $get) => $get('video_source') === 'youtube')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    // Extract YouTube ID
                                    $youtubeId = Media::extractYouTubeId($state);
                                    $set('youtube_id', $youtubeId);
                                    $set('media_type', 'video');
                                    $set('mime_type', 'video/youtube');
                                }
                            }),

                        Forms\Components\TextInput::make('duration')
                            ->label('Durata (secunde)')
                            ->numeric()
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                            ->helperText('Durata video-ului în secunde (opțional)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Setări Afișare')
                    ->description('Controlați cum și unde apare acest media')
                    ->schema([
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Vizibil')
                            ->helperText('Afișează acest media în galerii și carusel')
                            ->default(true),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Evidențiat')
                            ->helperText('Evidențiază acest media (apare primul în listări)'),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Ordine Sortare')
                            ->numeric()
                            ->default(0)
                            ->helperText('Numerele mai mici apar primele'),

                        Forms\Components\TextInput::make('alt_text')
                            ->label('Text Alternativ')
                            ->placeholder('Descrieți imaginea pentru accesibilitate')
                            ->helperText('Important pentru SEO și cititorii de ecran')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Etichete & Metadate')
                    ->description('Informații suplimentare și categorizare')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->label('Etichete')
                            ->placeholder('Adăugați etichete pentru a organiza media')
                            ->helperText('Apăsați Enter pentru a adăuga fiecare etichetă')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                // Hidden fields that are auto-populated
                Forms\Components\Hidden::make('file_name'),
                Forms\Components\Hidden::make('file_size'),
                Forms\Components\Hidden::make('mime_type'),
                Forms\Components\Hidden::make('youtube_id'),
            ]);
    }

    /**
     * Define the table schema for listing media items
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Previzualizare')
                    ->disk('public')
                    ->height(60)
                    ->width(80)
                    ->extraAttributes(['class' => 'rounded-lg'])
                    ->getStateUsing(function (Media $record) {
                        // Show YouTube thumbnail for YouTube videos
                        if ($record->isYouTube()) {
                            return $record->getYouTubeThumbnail('hqdefault');
                        }
                        return $record->file_path;
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titlu')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(30),

                Tables\Columns\BadgeColumn::make('media_type')
                    ->label('Tip')
                    ->colors([
                        'success' => 'image',
                        'warning' => 'video',
                    ])
                    ->icons([
                        'heroicon-o-photo' => 'image',
                        'heroicon-o-film' => 'video',
                    ]),

                Tables\Columns\TextColumn::make('video_category')
                    ->label('Categorie Video')
                    ->badge()
                    ->color('info')
                    ->visible(fn ($record) => $record && $record->media_type === 'video')
                    ->getStateUsing(function (Media $record) {
                        return $record->video_category ? Media::VIDEO_CATEGORIES[$record->video_category] ?? $record->video_category : null;
                    }),
                    
                Tables\Columns\BadgeColumn::make('video_source')
                    ->label('Sursă')
                    ->getStateUsing(function (Media $record) {
                        if ($record->media_type !== 'video') {
                            return null;
                        }
                        return $record->video_source === 'youtube' ? 'YouTube' : 'Local';
                    })
                    ->colors([
                        'danger' => 'YouTube',
                        'success' => 'Local',
                    ])
                    ->icons([
                        'heroicon-o-globe-alt' => 'YouTube',
                        'heroicon-o-document-film' => 'Local',
                    ])
                    ->visible(fn ($record) => $record && $record->media_type === 'video'),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durata')
                    ->getStateUsing(function (Media $record) {
                        return $record->getFormattedDuration();
                    })
                    ->visible(fn ($record) => $record && $record->media_type === 'video'),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Categorie')
                    ->colors([
                        'primary' => 'carousel',
                        'success' => 'gallery',
                        'warning' => 'hero',
                        'info' => 'events',
                        'gray' => 'other',
                    ]),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Evidențiat')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Vizibil')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('file_size')
                    ->label('Mărime')
                    ->formatStateUsing(fn ($state) => $state ? self::formatBytes($state) : 'Necunoscut')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Adăugat')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('media_type')
                    ->label('Tip Media')
                    ->options(Media::MEDIA_TYPES),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Categorie')
                    ->options(Media::CATEGORIES),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Elemente Evidențiate'),

                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Elemente Vizibile'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('view_file')
                        ->label('Vezi Fișier')
                        ->icon('heroicon-o-eye')
                        ->url(fn (Media $record): string => Storage::disk('public')->url($record->file_path))
                        ->openUrlInNewTab(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),

                    // Custom bulk actions
                    Tables\Actions\BulkAction::make('mark_featured')
                        ->label('Marchează ca Evidențiat')
                        ->icon('heroicon-o-star')
                        ->action(function ($records) {
                            $records->each->update(['is_featured' => true]);
                        })
                        ->requiresConfirmation()
                        ->color('warning'),

                    Tables\Actions\BulkAction::make('mark_visible')
                        ->label('Marchează ca Vizibil')
                        ->icon('heroicon-o-eye')
                        ->action(function ($records) {
                            $records->each->update(['is_visible' => true]);
                        }),

                    Tables\Actions\BulkAction::make('mark_hidden')
                        ->label('Marchează ca Ascuns')
                        ->icon('heroicon-o-eye-slash')
                        ->action(function ($records) {
                            $records->each->update(['is_visible' => false]);
                        })
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto-refresh every 30 seconds
    }

    /**
     * Define the relation managers
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Define the pages for this resource
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }

    /**
     * Modify query to include soft deleted items for admins
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    /**
     * Format bytes to human readable format
     */
    protected static function formatBytes(int $size, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }

    /**
     * Get navigation badge (shows total count)
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
