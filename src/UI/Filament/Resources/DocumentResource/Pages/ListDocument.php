<?php

namespace AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;

use AdminKit\Documents\UI\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;

class ListDocument extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync-reports')
                ->action('syncReports')
                ->requiresConfirmation()
                ->label('Синхронизировать с erg.kz')
                ->icon('heroicon-o-arrow-path'),
            Actions\CreateAction::make(),
        ];
    }

    public function syncReports(): void
    {
        Artisan::call('admin-kit-documents:sync-reports-from-ergkz');
        Notification::make()
            ->title('Документы синхронизированы')
            ->body('Синхронизация документов завершена')
            ->icon('heroicon-o-check-circle')
            ->success()
            ->send();
    }
}
