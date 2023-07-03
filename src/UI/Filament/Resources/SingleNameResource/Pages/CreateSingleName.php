<?php

namespace VendorName\Skeleton\UI\Filament\Resources\SingleNameResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use VendorName\Skeleton\UI\Filament\Resources\SingleNameResource;

class CreateSingleName extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SingleNameResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
