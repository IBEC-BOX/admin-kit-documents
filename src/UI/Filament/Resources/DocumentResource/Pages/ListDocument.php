<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use AdminKit\Documents\UI\Filament\Resources\DocumentResource;

class ListDocument extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = DocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
