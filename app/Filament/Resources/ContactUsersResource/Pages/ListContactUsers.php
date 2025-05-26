<?php

namespace App\Filament\Resources\ContactUsersResource\Pages;

use App\Filament\Resources\ContactUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUsers extends ListRecords
{
    protected static string $resource = ContactUsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
