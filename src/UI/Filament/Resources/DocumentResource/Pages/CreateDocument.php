<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return DocumentResource::getUrl();
    }

    public function mutateFormDataBeforeCreate($data):array
    {
        $data['slug'] = $this->data['slug'];

        return $data;
    }
}
