<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'date',
        'title',
        'body',
        'intro',
        'slug',
        'published'
    ];

    protected $casts = ['date' => 'date'];

    public $translatable = ['title', 'body', 'intro'];

    /**
     * @return BelongsToMany<Model,Post>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getImages()
    {
        return $this->getMedia('images')->map(fn($item) => $item->getUrl());
    }

    public function getFiles()
    {
        return $this->getMedia('files')->map(fn($item) => $item->getUrl());
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->isoFormat('D MMM Y');
    }
}
