<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display the specified user.
     */
    public function edit(User $user)
    {
        //
    }
    
    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
