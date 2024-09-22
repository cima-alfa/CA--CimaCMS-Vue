<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Response as InertiaView;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaView
    {
        return inertia('CP/Page/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaView
    {
        return inertia('CP/Page/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Page $page): InertiaView
    {
        return inertia('Front/Page');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
