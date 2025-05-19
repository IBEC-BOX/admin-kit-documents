<?php

namespace AdminKit\Documents\UI\Filament\Resources;

use AdminKit\Core\Forms\Components\TranslatableTabs;
use AdminKit\Documents\Models\Document;
use AdminKit\Documents\UI\Filament\Resources\DocumentResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Resource;
use Filament\Tables;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Документы';
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        $locale = app()->getLocale();

        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Grid::make()
                    ->columns()
                    ->columnSpan(2)
                    ->schema([
                        TranslatableTabs::make(fn ($locale) => Forms\Components\Tabs\Tab::make($locale)->schema([
                            Forms\Components\TextInput::make("title.$locale")
                                ->label(__('admin-kit-documents::documents.resource.title')),
                        ]))
                            ->columnSpan(2),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label(__('admin-kit-documents::documents.resource.published_at'))
                            ->columnSpan(1)
                            ->default(now()),
                    ]),

                Forms\Components\Tabs::make('')
                    ->columns(1)
                    ->tabs(fn () => [
                        Tab::make(__('admin-kit-documents::documents.resource.file'))
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                                    ->label(''),
                            ]),
                        Tab::make(__('admin-kit-documents::documents.resource.link'))
                            ->schema([
                                Forms\Components\TextInput::make('link')
                                    ->label('')
                                    ->placeholder('https://youtube.com/'),
                            ]),
                    ])
                    ->activeTab(fn (?Document $record) => $record?->link ? 2 : 1),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-documents::documents.resource.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('custom_title')
                    ->label(__('admin-kit-documents::documents.resource.title'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('admin-kit-documents::documents.resource.published_at')),
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
}
