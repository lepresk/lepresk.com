<?php

declare(strict_types=1);

namespace App\Filament\Resources\Works\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class WorkForm
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
                        Tabs\Tab::make('Content')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $state, callable $set) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Textarea::make('description')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),

                                MarkdownEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        // Tab 2: Media
                        Tabs\Tab::make('Media')
                            ->schema([


                                FileUpload::make('image_gallery')
                                    ->label('Image Gallery')
                                    ->image()
                                    ->directory('works/galleries')
                                    ->visibility('public')
                                    ->multiple()
                                    ->reorderable()
                                    ->maxFiles(10)
                                    ->maxSize(2048)
                                    ->columnSpanFull()
                                    ->helperText('Upload up to 10 images for the work gallery'),
                            ]),

                        // Tab 3: Taxonomy
                        Tabs\Tab::make('Taxonomy')
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

                        // Tab 4: SEO
                        Tabs\Tab::make('SEO')
                            ->schema([
                                Section::make('Meta Tags')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->maxLength(255)
                                            ->helperText('Leave empty to use work title'),

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
                                            ->helperText('Leave empty to use work title'),

                                        Textarea::make('og_description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull(),

                                        FileUpload::make('og_image')
                                            ->image()
                                            ->directory('works/og-images')
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

                                TextInput::make('order')
                                    ->label('Display Order')
                                    ->helperText('Lower numbers appear first')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),

                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('works/featured-images')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
