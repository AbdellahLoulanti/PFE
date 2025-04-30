<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $blogPost = static::getModel()::make($data);

        $blogPost->user()->associate(Auth::user());

        $blogPost->save();

        return $blogPost;
    }
}
