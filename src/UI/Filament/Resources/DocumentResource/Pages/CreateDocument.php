<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return DocumentResource::getUrl();
    }
}
