<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self generate(string $destinationUrl, null|bool $singleUse = false)
 */
final class ShortLink extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'short-link.generate';
    }
}
