<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentCategoryResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentCategory extends EditRecord
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
