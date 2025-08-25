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

    protected static ?string $navigationLabel = 'Media Gallery';

    protected static ?string $modelLabel = 'Media Item';

    protected static ?string $pluralModelLabel = 'Media Items';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Content';

    /**
     * Define the form schema for creating/editing media items
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Media Upload')
                    ->description('Upload your photo or video file, or provide a YouTube URL for videos')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Media File')
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
                                    
                                    // Set default title from filename
                                    if (!$set) {
                                        $fileName = pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME);
                                        $set('title', ucwords(str_replace(['_', '-'], ' ', $fileName)));
                                    }
                                    
                                    // Clear YouTube URL when file is uploaded
                                    $set('youtube_url', null);
                                }
                            })
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube URL (for videos only)')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('Alternative to file upload: provide a YouTube video URL. This will be used instead of uploaded file for videos.')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    // Auto-set media type to video when YouTube URL is provided
                                    $set('media_type', 'video');
                                    
                                    // Extract video title from YouTube if possible (basic implementation)
                                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $state, $matches)) {
                                        // Set some basic metadata
                                        $set('mime_type', 'video/youtube');
                                        $set('file_size', null);
                                    }
                                }
                            })
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media Information')
                    ->description('Add title, description and categorization')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter a descriptive title')
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Describe what this media shows...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('media_type')
                            ->label('Media Type')
                            ->options(Media::MEDIA_TYPES)
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options(Media::CATEGORIES)
                            ->default('gallery')
                            ->required()
                            ->native(false)
                            ->helperText('Gallery category is used for main carousel and galleries'),

                        Forms\Components\Select::make('video_category')
                            ->label('Video Category')
                            ->options(Media::VIDEO_CATEGORIES)
                            ->native(false)
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                            ->helperText('Specific category for video content'),

                        Forms\Components\Select::make('video_source')
                            ->label('Video Source')
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
                            ->label('YouTube URL')
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
                            ->label('Duration (seconds)')
                            ->numeric()
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                            ->helperText('Video duration in seconds (optional)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->description('Control how and where this media appears')
                    ->schema([
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible')
                            ->helperText('Show this media in galleries and carousel')
                            ->default(true),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->helperText('Highlight this media (appears first in listings)'),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),

                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->placeholder('Describe the image for accessibility')
                            ->helperText('Important for SEO and screen readers')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Tags & Metadata')
                    ->description('Additional information and categorization')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Add tags to help organize media')
                            ->helperText('Press Enter to add each tag')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                // Hidden fields that are auto-populated
                Forms\Components\Hidden::make('file_name'),
                Forms\Components\Hidden::make('file_size'),
                Forms\Components\Hidden::make('mime_type'),
            ])
            ->model(Media::class)
            ->statePath('data');
    }

    /**
     * Define the table schema for listing media items
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
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
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(30),

                Tables\Columns\BadgeColumn::make('media_type')
                    ->label('Type')
                    ->colors([
                        'success' => 'image',
                        'warning' => 'video',
                    ])
                    ->icons([
                        'heroicon-o-photo' => 'image',
                        'heroicon-o-film' => 'video',
                    ]),

                Tables\Columns\TextColumn::make('video_category')
                    ->label('Video Category')
                    ->badge()
                    ->color('info')
                    ->visible(fn ($record) => $record && $record->media_type === 'video')
                    ->getStateUsing(function (Media $record) {
                        return $record->video_category ? Media::VIDEO_CATEGORIES[$record->video_category] ?? $record->video_category : null;
                    }),
                    
                Tables\Columns\BadgeColumn::make('video_source')
                    ->label('Source')
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
                    ->label('Duration')
                    ->getStateUsing(function (Media $record) {
                        return $record->getFormattedDuration();
                    })
                    ->visible(fn ($record) => $record && $record->media_type === 'video'),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Category')
                    ->colors([
                        'primary' => 'carousel',
                        'success' => 'gallery',
                        'warning' => 'hero',
                        'info' => 'events',
                        'gray' => 'other',
                    ]),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('file_size')
                    ->label('Size')
                    ->formatStateUsing(fn ($state) => $state ? self::formatBytes($state) : 'Unknown')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('media_type')
                    ->label('Media Type')
                    ->options(Media::MEDIA_TYPES),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Category')
                    ->options(Media::CATEGORIES),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Items'),

                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Visible Items'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('view_file')
                        ->label('View File')
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
                        ->label('Mark as Featured')
                        ->icon('heroicon-o-star')
                        ->action(function ($records) {
                            $records->each->update(['is_featured' => true]);
                        })
                        ->requiresConfirmation()
                        ->color('warning'),

                    Tables\Actions\BulkAction::make('mark_visible')
                        ->label('Mark as Visible')
                        ->icon('heroicon-o-eye')
                        ->action(function ($records) {
                            $records->each->update(['is_visible' => true]);
                        }),

                    Tables\Actions\BulkAction::make('mark_hidden')
                        ->label('Mark as Hidden')
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
