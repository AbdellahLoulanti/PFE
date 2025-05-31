<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsersResource\Pages;
use App\Models\ContactMessage;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactUsersResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Management';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nom')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('message')->label('Message')->limit(50),
                TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListContactUsers::route('/'),
            'create' => Pages\CreateContactUsers::route('/create'),
            'edit' => Pages\EditContactUsers::route('/{record}/edit'),
        ];
    }
}
