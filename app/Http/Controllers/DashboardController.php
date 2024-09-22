<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response as InertiaView;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(): InertiaView
    {
        return inertia('CP/Dashboard');
    }
}
