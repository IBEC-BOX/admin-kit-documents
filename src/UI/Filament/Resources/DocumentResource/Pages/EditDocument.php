<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

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
