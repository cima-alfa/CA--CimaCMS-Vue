<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaView;

class UserProfileController extends Controller
{
    /**
     * Display the specified user.
     */
    public function edit(User $user): InertiaView
    {
        return inertia('CP/UserProfile/Edit');
    }
    
    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        return back();
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        return back();
    }
}
