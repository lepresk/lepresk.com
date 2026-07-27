<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Actions\TranslatePostToFrench;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Throwable;

/**
 * Translates a post into French with Claude, from the posts table or the edit page.
 */
final class TranslatePostAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Traduire en français')
            ->icon(Heroicon::Language)
            ->color('info')
            ->requiresConfirmation()
            ->modalHeading('Traduire cet article en français')
            ->modalDescription('La traduction est générée par Claude et prend de 30 à 90 secondes. Le contenu anglais n\'est pas modifié.')
            ->modalSubmitActionLabel('Traduire')
            ->visible(fn (Post $record): bool => ! $record->hasTranslation('content', 'fr'))
            ->action(function (Post $record): void {
                set_time_limit(0);

                try {
                    $post = app(TranslatePostToFrench::class)($record);
                } catch (Throwable $e) {
                    Notification::make()
                        ->title('La traduction a échoué')
                        ->body($e->getMessage())
                        ->danger()
                        ->persistent()
                        ->send();

                    return;
                }

                $slug = $post->getTranslation('slug', 'fr');

                Notification::make()
                    ->title('Article traduit')
                    ->body('Slug français : '.(is_string($slug) ? $slug : ''))
                    ->success()
                    ->send();
            });
    }

    public static function getDefaultName(): string
    {
        return 'translateToFrench';
    }
}
