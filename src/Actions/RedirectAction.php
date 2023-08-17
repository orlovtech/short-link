<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Actions;

use OrlovTech\ShortLink\Exceptions\LinkNotFoundException;
use OrlovTech\ShortLink\Models\ShortLink;

class RedirectAction
{
    public function __invoke(string $urlKey): string
    {
        $record = ShortLink::findByKey($urlKey);

        if ($record?->single_use === true) {
            $record->delete();
        }

        return $record->destination_url ?? throw new LinkNotFoundException();
    }
}
