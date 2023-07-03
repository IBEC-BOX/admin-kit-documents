<?php

declare(strict_types=1);

namespace AdminKit\Documents\Providers;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\PluginServiceProvider;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'documents';

    protected array $resources = [
        DocumentResource::class,
    ];
}
