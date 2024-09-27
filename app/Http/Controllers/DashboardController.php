<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response as InertiaView;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaView
    {
        return inertia('CP/Dashboard');
    }
}
