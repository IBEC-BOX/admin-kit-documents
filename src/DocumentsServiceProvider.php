<?php

namespace AdminKit\Documents;

use AdminKit\Documents\Commands\DocumentsCommand;
use AdminKit\Documents\Commands\SyncReportsFromErgkz;
use AdminKit\Documents\Providers\RouteServiceProvider;
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
            ->hasMigrations([
                'create_admin_kit_documents_table',
                'add_link_and_published_at_columns_to_admin_kit_documents_table',
                'create_admin_kit_document_categories_table',
                'add_category_id_column_to_admin_kit_documents_table',
                'add_ergkz_id_column_in_admin_kit_documents_table',
            ])
            ->hasCommands([
                DocumentsCommand::class,
                SyncReportsFromErgkz::class,
            ]);
    }

    public function registeringPackage()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
