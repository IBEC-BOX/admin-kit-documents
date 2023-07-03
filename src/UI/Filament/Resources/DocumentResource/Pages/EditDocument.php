<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use AdminKit\Documents\UI\Filament\Resources\DocumentResource;

class EditDocument extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = DocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
