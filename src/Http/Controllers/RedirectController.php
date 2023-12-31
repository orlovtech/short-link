<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Http\Controllers;

use OrlovTech\ShortLink\Actions\RedirectAction;

final class RedirectController
{
    public function __invoke(
        string $urlKey,
        RedirectAction $redirectAction,
    ) {
        $link = $redirectAction($urlKey);

        return redirect()->away($link);
    }
}
