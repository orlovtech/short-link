<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Services;

use Illuminate\Support\Str;
use OrlovTech\ShortLink\Models\ShortLink;

class LinkGenerateService
{
    public static function generateCode(string $link): string
    {
        $record = ShortLink::query()
            ->where('link', $link)
            ->first();

        $code = $record?->code;

        if (!$record) {
            $code = Str::uuid()->toString();

            ShortLink::query()
                ->create([
                    'code' => $code,
                    'link' => trim($link),
                ]);
        }

        return $code;
    }
}
