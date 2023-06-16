<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortLink extends Model
{
    use SoftDeletes;

    protected $table = 'short_links';

    protected $fillable = [
        'destination_url',
        'default_short_url',
        'url_key',
        'single_use',
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
        'single_use' => 'boolean',
    ];
}
