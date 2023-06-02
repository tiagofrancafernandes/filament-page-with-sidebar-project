<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class DynamicContent extends Model implements HasMedia
{
    use HasFactory;
    // use HasUuid; // Cria uma coluna chmada uuid
    use HasUuids;
    use InteractsWithMedia;

    protected $fillable = [
        'organization_id',
        'slug',
        'title',
        'cover_image',
        'small_description',
        'content',
        'active',
        'css_code',
        'js_code',
        'html_code',
        'show_from',
        'show_to',
        'search_tags',
    ];

    protected $casts = [
        'active' => 'boolean',
        'show_from' => 'datetime',
        'show_to' => 'datetime',
        'search_tags' => AsCollection::class,
    ];
}
