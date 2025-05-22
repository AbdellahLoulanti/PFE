<?php

namespace App\Filament\Resources\ContactUsersResource\Pages;

use App\Filament\Resources\ContactUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUsers extends EditRecord
{
    protected static string $resource = ContactUsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Message  deleted';
    }
}
