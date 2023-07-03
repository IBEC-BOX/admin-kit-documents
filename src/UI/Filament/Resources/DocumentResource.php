<?php

namespace AdminKit\Documents\UI\Filament\Resources;

use AdminKit\Documents\Models\Document;
use AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class DocumentResource extends Resource
{
    use Translatable;

    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-x';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin-kit-documents::documents.resource.title'))
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-documents::documents.resource.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin-kit-documents::documents.resource.title')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin-kit-documents::documents.resource.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListDocument::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin-kit-documents::documents.resource.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin-kit-documents::documents.resource.plural_label');
    }

    public static function getTranslatableLocales(): array
    {
        return config('admin-kit.locales');
    }
}
