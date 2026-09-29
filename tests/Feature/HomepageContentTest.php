<?php

declare(strict_types=1);

it('presents the current role, the updated career and the Columbia certificate', function (string $locale, string $period, string $degree, string $users, string $title): void {
    $this->withoutVite();

    $response = $this->get('/?lang='.$locale);

    $response->assertSuccessful()
        ->assertSee('Chief Technology Officer', false)
        ->assertSee('Columbia Business School', false)
        ->assertSee($period, false)
        ->assertSee($degree, false)
        ->assertSee($users, false)
        ->assertSee($title, false)
        ->assertSee('Akieni Academy', false)
        ->assertSee('Leadership', false)
        ->assertSee('info@lepresk.com', false)
        ->assertSee('+242 06 851 13 58', false)
        ->assertSee('PHP / Laravel', false)
        ->assertSee('MySQL/MariaDB', false)
        ->assertSee('Redis', false)
        ->assertSee('ASP.NET Core / C#', false)
        ->assertSee('Laravel, Python, TypeScript', false)
        ->assertDontSee('j\'écris en Laravel', false)
        ->assertDontSee('I write Laravel', false)
        ->assertDontSee('Leadership en Ingénierie', false)
        ->assertDontSee('Execution diagnosis', false)
        ->assertSee('Flutter', false)
        ->assertSee('React Native', false)
        ->assertDontSee('March 2025 – Present', false)
        ->assertDontSee('Mars 2025 – Présent', false);

    expect($response->getContent())->not->toMatch('/bg-primary"><\/div>\s*Go\s*<\/li>/')
        ->and($response->getContent())->not->toMatch('/rounded-full bg-primary\/10[^>]*>\s*(Claude Code|Codex|Cursor)\s*</')
        ->and(mb_strlen($title))->toBeLessThanOrEqual(60);
})->with([
    'english' => ['en', 'June 2026 – Present', 'Certificate in Business Excellence', '40,000', 'Lepres Kikounga | CTO in Brazzaville'],
    'french' => ['fr', 'Juin 2026 – Présent', 'Licence professionnelle, Réseaux et télécommunications', '40 000', 'Lepres Kikounga | CTO à Brazzaville'],
]);
