<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts\Pages;

use App\Cache\BlogCache;
use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
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
                    BlogCache::flush();

                    Notification::make()->title('Cache flushed')->success()->send();
                }),
            CreateAction::make(),
        ];
    }
}
