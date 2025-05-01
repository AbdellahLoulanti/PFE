<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required(),
                TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->required(),
                Select::make('visibility')
                    ->options([
                        'public' => 'Public',
                        'private' => 'Private',
                    ])
                    ->required(),
                FileUpload::make('cover_image')
                    ->image()
                    ->directory('event-covers')
                    ->disk('public'),

                TextInput::make('tags')
                    ->label('Tags (séparés par des virgules)')
                    ->helperText('Exemple : technologie, santé, éducation'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Image')
                    ->circular(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Début')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Fin')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('visibility')
                    ->badge()
                    ->label('Visibilité')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'public' => 'Public',
                        'private' => 'Privé',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'public' => 'success',
                        'private' => 'danger',
                        default => 'gray',
                    }),
            ])
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
