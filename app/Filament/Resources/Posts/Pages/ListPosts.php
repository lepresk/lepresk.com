<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

final class ListPosts extends ListRecords
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Action::make('flushCache')
                ->label('Flush Cache')
                ->icon(Heroicon::ArrowPath)
                ->color('warning')
                ->requiresConfirmation()
                ->action(function (): void {
                    Post::query()->get()->each(function (Post $post): void {
                        foreach ($post->slugsInAllLocales() as $slug) {
                            Cache::forget("post.slug:{$slug}");
                        }
                    });

                    for ($i = 1; $i <= 20; $i++) {
                        Cache::forget("blog.index.page:{$i}");
                    }

                    Notification::make()->title('Cache flushed')->success()->send();
                }),
            CreateAction::make(),
        ];
    }
}
