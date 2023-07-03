<?php

namespace VendorName\Skeleton\UI\Filament\Resources\SingleNameResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use VendorName\Skeleton\UI\Filament\Resources\SingleNameResource;

class ListSingleName extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SingleNameResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
