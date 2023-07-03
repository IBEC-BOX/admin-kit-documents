<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use AdminKit\Documents\UI\Filament\Resources\DocumentResource;

class CreateDocument extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = DocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
