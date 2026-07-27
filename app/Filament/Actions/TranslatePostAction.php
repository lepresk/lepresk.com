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
 *
 * The same action covers the first translation and a later rewrite: only one of
 * the two shows up on a given post, depending on whether a french version exists.
 */
final class TranslatePostAction extends Action
{
    private bool $overwrite = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (): string => $this->overwrite ? 'Retraduire en français' : 'Traduire en français')
            ->icon(Heroicon::Language)
            ->color(fn (): string => $this->overwrite ? 'warning' : 'info')
            ->requiresConfirmation()
            ->modalHeading(fn (): string => $this->overwrite
                ? 'Regénérer la version française'
                : 'Traduire cet article en français')
            ->modalDescription(fn (): string => $this->overwrite
                ? 'La version française actuelle sera remplacée par une nouvelle traduction de la version anglaise. Le slug français est conservé pour ne pas casser l\'URL. Compter de 30 à 90 secondes.'
                : 'La traduction est générée par Claude et prend de 30 à 90 secondes. Le contenu anglais n\'est pas modifié.')
            ->modalSubmitActionLabel(fn (): string => $this->overwrite ? 'Remplacer' : 'Traduire')
            ->visible(fn (Post $record): bool => $record->hasTranslation('content', 'fr') === $this->overwrite)
            ->action(function (Post $record): void {
                set_time_limit(0);

                try {
                    $post = app(TranslatePostToFrench::class)($record, $this->overwrite);
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
                    ->title($this->overwrite ? 'Version française regénérée' : 'Article traduit')
                    ->body('Slug français : '.(is_string($slug) ? $slug : ''))
                    ->success()
                    ->send();
            });
    }

    public static function getDefaultName(): string
    {
        return 'translateToFrench';
    }

    /**
     * The variant that rewrites an existing french version.
     */
    public static function rewrite(): static
    {
        $action = self::make('retranslateToFrench');
        $action->overwrite = true;

        return $action;
    }
}
