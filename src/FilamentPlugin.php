<?php

namespace AdminKit\Documents;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-plugin-admin-kit-documents';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            DocumentResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }
}