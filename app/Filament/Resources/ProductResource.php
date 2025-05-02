<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                Textarea::make('description'),
                TextInput::make('price')->required()->numeric(),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->label('Stock disponible'),
                TextInput::make('category'),
                FileUpload::make('image')
                    ->directory('products')
                    ->image()
                    ->imagePreviewHeight('150')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(fn ($record) => Storage::url($record->image))
                    ->width(80)
                    ->height(80)
                    ->extraImgAttributes([
                        'style' => 'object-fit: cover; border: 1px solid black;',
                    ]),
                TextColumn::make('price')->money('MAD', true),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('stock'),
                TextColumn::make('category'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
