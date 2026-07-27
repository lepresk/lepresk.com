<?php

declare(strict_types=1);

it('renders the welcome page', function (): void {
    $page = visit('/');

    $page->assertSee('Blog')
        ->assertNoJavaScriptErrors();
});
