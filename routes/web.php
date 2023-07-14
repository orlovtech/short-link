<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use OrlovTech\ShortLink\Http\Controllers\RedirectController;

Route::get('short/{urlKey}', RedirectController::class);
