<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Actions;

use Illuminate\Support\Str;
use OrlovTech\ShortLink\Exceptions\WrongLinkException;
use OrlovTech\ShortLink\Models\ShortLink;

final class GenerateAction
{
    public function generate(
        string $destinationUrl,
        bool $singleUse = false,
    ): ShortLink {
        if (! Str::isUrl($destinationUrl)) {
            throw new WrongLinkException();
        }

        $urlKey = $this->urlKey();

        return ShortLink::query()
            ->create([
                'url_key' => $urlKey,
                'destination_url' => trim($destinationUrl),
                'default_short_url' => config('short-link.prefix').$urlKey,
                'single_use' => $singleUse,
            ]);
    }

    private function urlKey(): string
    {
        return Str::limit(Str::orderedUuid()->toString(), 13, '');
    }
}
