<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $destination_url
 * @property string $default_short_url
 * @property string $url_key
 * @property bool $single_use
 * @property datetime $created_at
 * @property datetime $updated_at
 * @property datetime $deleted_at
 */
class ShortLink extends Model
{
    use SoftDeletes;

    protected $table = 'short_links';

    protected $fillable = [
        'destination_url',
        'url_key',
        'single_use',
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'deleted_at' => 'immutable_datetime',
        'single_use' => 'boolean',
    ];

    protected $appends = ['default_short_url'];

    public function getDefaultShortUrlAttribute(): string
    {
        return rtrim((string) config('short-link.prefix'), '/') . '/' . ((string) $this->url_key);
    }

    public static function findByKey(string $urlKey): ?self
    {
        return self::query()
            ->select('id', 'destination_url', 'single_use')
            ->where('url_key', trim($urlKey))
            ->first();
    }
}
