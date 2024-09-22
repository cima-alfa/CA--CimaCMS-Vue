<?php

declare(strict_types=1);

/**
 * "cp" shorhand is available for retreiving "control-panel" config
 * Example: config('cp', []); is equal to config('control-panel', []);
 */

return [
    'router' => [
        'prefix' => env('CP_ROUTER_PREFIX', '/control-panel')
    ]
];