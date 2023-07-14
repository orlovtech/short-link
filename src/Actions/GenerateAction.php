<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Actions;

use Illuminate\Support\Str;
use OrlovTech\ShortLink\Models\ShortLink;

final class GenerateAction
{
    public function generate(
        string $destinationUrl,
        bool $singleUse = false,
    ): ShortLink {
        return ShortLink::query()
            ->create([
                'url_key'           => $this->urlKey(),
                'destination_url'   => trim($destinationUrl),
                'default_short_url' => config('short-link.prefix') . $this->urlKey(),
                'single_use'        => $singleUse,
            ]);
    }

    private function urlKey(): string
    {
        return Str::uuid()->toString();
    }
}
