<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
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

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                TextInput::make('tags')
                    ->label('Tags (séparés par des virgules)')
                    ->placeholder('ex: Santé, Technologie, ...')
                    ->helperText('Entrez les tags séparés par des virgules'),

                Textarea::make('content')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])->default('draft')
                    ->required()
                    ->native(false),

                FileUpload::make('image')
                    ->label('Image de couverture')
                    ->directory('blog-posts')
                    ->image()
                    ->imagePreviewHeight(150)
                    ->visibility('public')
                    ->preserveFilenames()
                    ->loadingIndicatorPosition('left')
                    ->panelLayout('compact')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('tags')
                    ->label('Tags')
                    ->limit(30),

                TextColumn::make('slug'),
                ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(fn ($record) => $record->image ? asset('storage/'.$record->image) : null)
                    ->width(80)
                    ->height(80)
                    ->extraImgAttributes([
                        'style' => 'object-fit: cover; border: 1px solid black;',
                    ]),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime(),

                TextColumn::make('user.name')->label('User name'),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
