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
use Illuminate\Support\Facades\App;

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
                    // ->default(date('Y-m-d'))
                    ->required()
                    ->columnSpan(1),
                Forms\Components\Checkbox::make('published')
                    ->label(__('Publicar'))
                    ->columnSpanFull(),
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
                    ->relationship(
                        name: 'categories',
                        titleAttribute: 'name'
                    )
                    // ->multiple()
                    ->searchable()
                    ->preload()
                    ->required(),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label(__('Imágenes'))
                    ->collection('images')
                    ->reorderable()
                    ->multiple()
                    ->panelLayout('grid')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('files')
                    ->label(__('Documentos adjuntos'))
                    ->collection('files')
                    ->reorderable()
                    ->multiple()
                    ->columnSpanFull(),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')->label(__('Data'))->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('title')->label(__('Títol'))->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->where('title', 'ilike', "%{$search}%");
                }),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('published')
                    ->label(__('Publicat'))
                    ->boolean()
                    ->trueLabel(__('Si'))
                    ->falseLabel(__('No'))
                    ->native(false),
                Tables\Filters\SelectFilter::make('categories')
                    ->label(__('Categories'))
                    ->relationship('categories', 'name')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
