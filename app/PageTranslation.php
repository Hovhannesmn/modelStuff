<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'settings'];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array'
    ];
}
