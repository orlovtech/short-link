<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use OrlovTech\ShortLink\Http\Controllers\RedirectController;

Route::get(rtrim((string) config('short-link.prefix'), '/').'/{urlKey}', RedirectController::class);
