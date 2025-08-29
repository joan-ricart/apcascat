<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'specialties' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
