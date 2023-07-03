<?php

declare(strict_types=1);

namespace VendorName\Skeleton\Providers;

use Filament\PluginServiceProvider;
use VendorName\Skeleton\UI\Filament\Resources\SingleNameResource;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'skeleton_without_prefix';

    protected array $resources = [
        SingleNameResource::class,
    ];
}
