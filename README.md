<p align="center">
  <img src="art/cover.jpg" alt="lepresk.com" width="100%">
</p>

<p align="center">
  Portfolio and blog of Lepres Kikounga, live at <a href="https://lepresk.com">lepresk.com</a>.
</p>

---

A bilingual site built on Laravel 12 and Filament 4. Articles are written in English in the admin panel, then translated into French by Claude from that same interface, without leaving the back office.

## Features

### Bilingual blog, one URL per article

Title, slug, excerpt, content and SEO metadata are translatable (`spatie/laravel-translatable`, JSON columns). The language comes from the `?lang=` parameter, then the cookie, then the `Accept-Language` header. The URL scheme stays `/blog/{slug}` with no language prefix: an article answers to both its English and its French slug, and falls back to the default language when a translation is missing.

### Automatic EN to FR translation

An admin action generates the French version of an article, and a second one regenerates it. Two `laravel/ai` agents run on `claude-sonnet-5`: one translates the markdown body, the other returns every short field plus a short French slug in a single structured call.

What the translation guarantees, enforced in PHP rather than trusted to the model:

- **images survive** — the URLs of the source are compared with the ones that came back, and the article is left untouched if any went missing
- **French keeps its accents** — a translation whose accented letter ratio collapses is refused, not published
- **typography stays plain** — em dashes, curly quotes and non-breaking spaces are replaced by their plain equivalents
- **the slug stays short and readable** — elided particles removed, 60 characters maximum cut on a word boundary, uniqueness checked across every language
- **a published URL never moves** — regenerating keeps the existing French slug

The translator's instructions carry the prompt cache breakpoint, since the article itself differs on every call.

### Computed read time

Left empty, it is derived from the content at 200 words per minute, and recomputed when the content changes as long as the value was not typed by hand.

### Portfolio

Projects with an image gallery, opened in a full screen lightbox: keyboard navigation, touch swipe, counter, scroll locking and focus restored on close. No JavaScript dependency added.

### Filament admin

Protected panel for articles, projects, categories and tags. Language switcher on the list, create and edit pages. Signed URL preview of a draft, cache flushing, translation actions.

### Caching

The rendered HTML is cached server side with the language in the key, so parsing an article's markdown is not repeated on every visit. `App\Cache\BlogCache` is the only place that builds those keys, and invalidation covers create, edit, translate, delete, restore and force delete, for every slug in every language.

Pages are not cached in the browser: both languages answer on the same URL and the host strips the `Vary` header.

### SEO

`canonical` and `hreflang` per article, alternates limited to translations that actually exist, XML sitemap per language, Open Graph and Twitter Card, `BlogPosting` structured data. Custom 404, 419 and 500 pages.

## Stack

| | |
|---|---|
| Backend | PHP 8.4, Laravel 12, Filament 4 |
| Frontend | Blade, Tailwind 4, Vite 7, framework-free JavaScript |
| AI | `laravel/ai` on Claude Sonnet 5 |
| Database | MariaDB in production, SQLite in tests |
| Quality | Pest 4, PHPStan `level: max` through Larastan, Pint, Rector |

## Development

```bash
composer install
pnpm install
cp .env.example .env && php artisan key:generate
php artisan migrate
php artisan storage:link
composer run dev
```

`ANTHROPIC_API_KEY` is required for the translation actions, not for the rest of the site.

## Tests

```bash
php artisan test                       # 77 tests
php artisan test --testsuite=Browser   # Playwright, needs npx playwright install
vendor/bin/pint --dirty
vendor/bin/phpstan analyse --memory-limit=2G
```

AI agents are faked across the suite: `preventStrayPrompts()` guarantees no test reaches the network.

## Deployment

On a push to `main`, GitHub Actions builds the assets on the runner, rsyncs the source and the compiled assets to the shared host, then runs the migrations and the optimization commands. Assets are not built on the server: esbuild allocates enough memory to be killed there, and an interrupted build left the site without a Vite manifest.

## License

© 2026 Lepres Kikounga. All rights reserved.
