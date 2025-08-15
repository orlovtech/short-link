<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Actions;

use Illuminate\Support\Str;
use OrlovTech\ShortLink\Exceptions\WrongLinkException;
use OrlovTech\ShortLink\Models\ShortLink;

class GenerateAction
{
    public function generate(
        string $destinationUrl,
        bool $singleUse = false,
    ): ShortLink {
        if (filter_var($destinationUrl, FILTER_VALIDATE_URL) === false) {
            throw new WrongLinkException();
        }

        $urlKey = $this->urlKey();

        return ShortLink::query()
            ->create([
                'url_key' => $urlKey,
                'destination_url' => trim($destinationUrl),
                'single_use' => $singleUse,
            ]);
    }

    public function urlKey(): string
    {
        return Str::limit(Str::orderedUuid()->toString(), 13, '');
    }
}
