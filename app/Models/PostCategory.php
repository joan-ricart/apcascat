<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class PostCategory extends Model
{
    use HasTranslations;

    protected $guarded = ['id'];

    public $translatable = ['name'];

    /**
     * @return BelongsToMany<Model,Post>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)->published();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
