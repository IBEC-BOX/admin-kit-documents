<?php

namespace AdminKit\Documents;

use AdminKit\Documents\Commands\DocumentsCommand;
use AdminKit\Documents\Models\Document;
use AdminKit\Documents\Providers\FilamentServiceProvider;
use AdminKit\Documents\Providers\RouteServiceProvider;
use Filament\Forms\Components\Select;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DocumentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('admin-kit-documents')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigration('create_admin_kit_documents_table')
            ->hasCommand(DocumentsCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->register(FilamentServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    public function packageBooted()
    {
        FilamentNavigation::addItemType(trans('admin-kit-documents::documents.resource.label'), [
            Select::make('document_id')
                ->label(__('admin-kit-documents::documents.resource.label'))
                ->searchable()
                ->options(function () {
                    return Document::pluck('name', 'id');
                }),
        ]);
    }
}
