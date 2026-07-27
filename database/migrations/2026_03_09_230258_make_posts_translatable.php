<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Columns to convert to JSON for translatable support.
     *
     * @var array<int, string>
     */
    private array $translatableColumns = [
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];

    public function up(): void
    {
        // Step 1: Wrap existing data in {"en": "value"} format
        foreach ($this->translatableColumns as $column) {
            if ($this->usesMysqlSyntax()) {
                DB::statement(
                    "UPDATE posts SET `{$column}` = JSON_OBJECT('en', `{$column}`) WHERE `{$column}` IS NOT NULL"
                );
            } else {
                // SQLite: use json_object()
                DB::statement(
                    "UPDATE posts SET \"{$column}\" = json_object('en', \"{$column}\") WHERE \"{$column}\" IS NOT NULL"
                );
            }
        }

        // Step 2: Drop the indexes on slug before it becomes JSON.
        // MySQL and MariaDB store JSON as LONGTEXT and refuse a key on such a
        // column without a prefix length, so the ALTER would fail otherwise.
        // Uniqueness is enforced at the application level from now on.
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropIndex(['slug']);
        });

        // Step 3: Change column types to JSON
        Schema::table('posts', function (Blueprint $table): void {
            $table->json('title')->change();
            $table->json('slug')->change();
            $table->json('excerpt')->nullable()->change();
            $table->json('content')->change();
            $table->json('meta_title')->nullable()->change();
            $table->json('meta_description')->nullable()->change();
            $table->json('meta_keywords')->nullable()->change();
            $table->json('og_title')->nullable()->change();
            $table->json('og_description')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Unwrap JSON back to plain text (extract 'en' value)
        foreach ($this->translatableColumns as $column) {
            if ($this->usesMysqlSyntax()) {
                DB::statement(
                    "UPDATE posts SET `{$column}` = JSON_UNQUOTE(JSON_EXTRACT(`{$column}`, '$.en')) WHERE `{$column}` IS NOT NULL"
                );
            } else {
                DB::statement(
                    "UPDATE posts SET \"{$column}\" = json_extract(\"{$column}\", '$.en') WHERE \"{$column}\" IS NOT NULL"
                );
            }
        }

        Schema::table('posts', function (Blueprint $table): void {
            $table->string('title')->change();
            $table->string('slug')->change();
            $table->text('excerpt')->nullable()->change();
            $table->longText('content')->change();
            $table->string('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->string('meta_keywords', 500)->nullable()->change();
            $table->string('og_title')->nullable()->change();
            $table->text('og_description')->nullable()->change();

            $table->unique('slug');
            $table->index('slug');
        });
    }

    /**
     * MariaDB reports its own driver name but speaks the MySQL dialect,
     * including backtick quoting, which SQLite's syntax would break.
     */
    private function usesMysqlSyntax(): bool
    {
        return in_array(DB::getDriverName(), ['mysql', 'mariadb'], true);
    }
};
