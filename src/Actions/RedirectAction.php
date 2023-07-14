<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Actions;

use OrlovTech\ShortLink\Exceptions\LinkNotFoundException;
use OrlovTech\ShortLink\Models\ShortLink;

final class RedirectAction
{
    public function __invoke(string $urlKey): string
    {
        $record = ShortLink::query()
            ->where('url_key', trim($urlKey))
            ->first();

        if ($record?->single_use === true) {
            $record->delete();
        }

        return $record->destination_url ?? throw new LinkNotFoundException();
    }
}
