<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class BlogPost extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
protected static function booted()
{
    static::creating(function ($blogPost) {
        $blogPost->user_id = Auth::id();
    });
}

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'tags', 
        'user_id'
        
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title' 
            ]
        ];
    }    
    use HasSlug;

public function getSlugOptions(): SlugOptions
{
    return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug')
        ->doNotGenerateSlugsOnUpdate(); 
}
}
