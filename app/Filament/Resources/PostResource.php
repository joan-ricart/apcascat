<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getNavigationLabel(): string
    {
        return __('Noticias');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Noticias');
    }

    public static function getModelLabel(): string
    {
        return __('Noticia');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Título'))
                    ->maxLength(255)
                    ->required()
                    ->live('onBlur')
                    ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                        if ($operation == 'edit' || is_null($state)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    })
                    ->columnSpan(2),
                Forms\Components\TextInput::make('slug')
                    ->label(__('Fragmento de url'))
                    ->required()
                    ->rules([
                        fn(Get $get) => UniqueTranslationRule::for('posts', 'slug')->ignore($get('id'))
                    ]),
                Forms\Components\DatePicker::make('date')
                    ->label(__('Fecha'))
                    ->default(date('now'))
                    ->required()
                    ->columnSpan(1),
                Forms\Components\RichEditor::make('body')
                    ->label(__('Cuerpo'))
                    ->columnSpanFull()
                    ->disableToolbarButtons(['attachFiles'])
                    ->required(),
                Forms\Components\Textarea::make('intro')
                    ->label(__('Intro'))
                    ->columnSpanFull()
                    ->rows(6)
                    ->cols(20)
                    ->autosize(),
                Forms\Components\Select::make('categories')
                    ->label(__('Categorías'))
                    ->columnSpanFull()
                    ->relationship(titleAttribute: 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->required(),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label(__('Imágenes'))
                    ->collection('post_images')
                    ->reorderable()
                    ->multiple()
                    ->panelLayout('grid')
                    ->columnSpanFull(),
                Forms\Components\Checkbox::make('published')
                    ->label(__('Visible'))
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
