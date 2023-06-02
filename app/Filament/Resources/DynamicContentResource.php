<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DynamicContent;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Filament\Resources\DynamicContentResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class DynamicContentResource extends Resource
{
    protected static ?string $model = DynamicContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('organization_id'),
                Forms\Components\TextInput::make('title')
                    ->translateLabel()
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->label(__('Identifier of the :item (visible in the URL)', ['item' => 'item']))
                    // ->unique()
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\TextInput::make('small_description')
                ->label(__('Small description'))
                ->columnSpan(2),
                SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label(__('Cover image'))
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('content')
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'undo',
                ])
                ->translateLabel()
                    ->columnSpan(2),

                Select::make('status')->label(__('Status'))
                    ->options(function () {
                        $filteredArray = [];

                        foreach ([
                            0 => __('Inactive'),
                            1 => __('Active'),
                        ] as $key => $value) {
                            $filteredArray[$key] = $value;
                        }

                        return $filteredArray;
                    })
                    ->searchable(),
                Forms\Components\Toggle::make('active')
                    ->label(__('Active')),
                Forms\Components\Textarea::make('html_code')->label(__('HTML code')),
                Forms\Components\Textarea::make('js_code')->label(__('CSS code')),
                Forms\Components\Textarea::make('css_code')->label(__('JS code')),
                Forms\Components\Textarea::make('search_tags')
                    ->label(
                        __('Search tags (searchable)') . ' (' .
                            __('separate by comma') . ')'
                    ),
                Forms\Components\DateTimePicker::make('show_from')
                    ->label(__('Show from'))
                    ->helperText(__('empty means :status', ['status' => __('no restrict by date')])),
                Forms\Components\DateTimePicker::make('show_to')
                    ->label(__('Show to'))
                    ->helperText(__('empty means :status', ['status' => __('no restrict by date')])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                // Tables\Columns\TextColumn::make('organization_id'),
                Tables\Columns\TextColumn::make('title'),
                // Tables\Columns\TextColumn::make('cover_image'),
                // Tables\Columns\TextColumn::make('small_description'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('show_from')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('show_to')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('search_tags')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDynamicContents::route('/'),
            'create' => Pages\CreateDynamicContent::route('/create'),
            'edit' => Pages\EditDynamicContent::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Dynamic content');
        // return __('filament-shield::filament-shield.resource.label.role');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Dynamic contents');
        // return __('filament-shield::filament-shield.resource.label.roles');
    }

    protected static function getNavigationGroup(): ?string
    {
        return trans('CMS');
        // return Utils::isResourceNavigationGroupEnabled()
        //     ? __('filament-shield::filament-shield.nav.group')
        //     : '';
    }
}
