<?php

namespace App\Filament\Resources\ContactUsersResource\Pages;

use App\Filament\Resources\ContactUsersResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form as FilamentForm; // Alias pour clarté
use Filament\Resources\Pages\EditRecord;

class EditContactUsers extends EditRecord
{
    protected static string $resource = ContactUsersResource::class;

    public function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema($this->getFormSchema());
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->disabled(),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->disabled(),

            Forms\Components\Textarea::make('message')
                ->label('Message')
                ->rows(5)
                ->disabled(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Message deleted';
    }
}
