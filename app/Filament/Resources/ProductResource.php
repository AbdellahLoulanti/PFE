<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'management';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('MAD'),
            FileUpload::make('image')
                ->directory('product-images')
                ->disk('public')
                ->image()
                ->imagePreviewHeight('250')
                ->label('Image du produit'),
            Forms\Components\Textarea::make('description')
                ->rows(5)
                ->label('Description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('image')
                ->disk('public')
                ->label('Image')
                ->circular(),
            TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Nom'),
            TextColumn::make('price')
                ->money('MAD')
                ->sortable()
                ->label('Prix'),
            TextColumn::make('created_at')
                ->dateTime('d/m/Y H:i')
                ->label('Créé le'),
        ])
        ->filters([
            // Ajoutez des filtres si nécessaire
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
