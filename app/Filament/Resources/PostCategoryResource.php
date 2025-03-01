<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostCategoryResource\Pages;
use App\Filament\Resources\PostCategoryResource\RelationManagers;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PostCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = PostCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function getNavigationLabel(): string
    {
        return __('Categorías de noticia');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Categorías de noticia');
    }

    public static function getModelLabel(): string
    {
        return __('Categoría de noticia');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Nombre'))
                    ->live('onBlur')
                    ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                        if ($operation == 'edit' || is_null($state)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label(__('Fragmento de url'))
                    ->rules([
                        fn(Get $get) => UniqueTranslationRule::for('post_categories', 'slug')->ignore($get('id'))
                    ])
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
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
            'index' => Pages\ListPostCategories::route('/'),
            'create' => Pages\CreatePostCategory::route('/create'),
            'edit' => Pages\EditPostCategory::route('/{record}/edit'),
        ];
    }
}
