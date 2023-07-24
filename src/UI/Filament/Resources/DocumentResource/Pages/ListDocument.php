<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocument extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
