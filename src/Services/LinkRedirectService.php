<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Services;

use OrlovTech\ShortLink\Exceptions\LinkNotFoundException;
use OrlovTech\ShortLink\Models\ShortLink;

final class LinkRedirectService
{
    public function getLink(string $code)
    {
        $record = ShortLink::query()
            ->where('code', trim($code))
            ->first();

        return $record->link ?? throw new LinkNotFoundException('Link not found');
    }
}
