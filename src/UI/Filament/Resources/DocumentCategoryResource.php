<?php

namespace AdminKit\Documents\UI\Filament\Resources;

use AdminKit\Core\Forms\Components\TranslatableTabs;
use AdminKit\Documents\Models\DocumentCategory;
use AdminKit\Documents\UI\Filament\Resources\DocumentCategoryResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentCategoryResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'Категория документов';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Категории документов';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Документы';
    }

    public static function getTitleCaseModelLabel(): string
    {
        return self::getModelLabel();
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return self::getPluralModelLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make(fn ($locale) => [
                    TextInput::make("title.$locale")
                        ->label('Наименование')
                        ->required($locale === app()->getLocale()),
                ])
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Наименование')
                    ->limit(30),
                Tables\Columns\TextColumn::make('sort')
                    ->label('Порядок'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentCategory::route('/'),
            'create' => Pages\CreateDocumentCategory::route('/create'),
            'edit' => Pages\EditDocumentCategory::route('/{record}/edit'),
        ];
    }
}
