<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Tabs::make('Content')
                    ->columnSpan(2)
                    ->tabs([
                        // Tab 1: Content
                        Tab::make('Content')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Textarea::make('excerpt')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull(),

                                MarkdownEditor::make('content')
                                    ->required()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('blog')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 2: Taxonomy
                        Tab::make('Taxonomy')
                            ->schema([
                                Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(100),
                                        Select::make('type')
                                            ->options([
                                                'post' => 'Posts only',
                                                'work' => 'Works only',
                                                'both' => 'Both',
                                            ])
                                            ->default('both')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(100),
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        // Tab 3: SEO
                        Tab::make('SEO')
                            ->schema([
                                Section::make('Meta Tags')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->maxLength(255)
                                            ->helperText('Leave empty to use post title'),

                                        Textarea::make('meta_description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull(),

                                        TextInput::make('meta_keywords')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Open Graph')
                                    ->schema([
                                        TextInput::make('og_title')
                                            ->maxLength(255)
                                            ->helperText('Leave empty to use post title'),

                                        Textarea::make('og_description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull(),

                                        FileUpload::make('og_image')
                                            ->image()
                                            ->directory('posts/og-images')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),

                Group::make()
                    ->schema([
                        Section::make('Publishing')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('draft')
                                    ->required(),

                                DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->default(now()),

                                TextInput::make('read_time')
                                    ->placeholder('8 min')
                                    ->helperText('Laisser vide pour le calculer automatiquement à partir du contenu.')
                                    ->maxLength(20),
                            ]),

                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('posts/featured-images')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
