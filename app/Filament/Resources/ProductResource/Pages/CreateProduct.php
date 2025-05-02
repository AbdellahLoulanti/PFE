<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        
        $product = static::getModel()::make($data);

       
        $product->user()->associate(Auth::user());

        
        $product->save();

        return $product;
    }
}
