<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Inertia\Response as InertiaView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class PasswordResetController extends Controller
{
    /**
     * Show the user password reset page.
     */
    public function create(): InertiaView
    {
        return inertia('CP/Auth/PasswordReset/Request', [
            'notificationStatus' => session('notificationStatus'),
            'resetStatus' => session('resetStatus')
        ]);
    }

    /**
     * Send the password reset notice to the user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $notificationStatus = Password::sendResetLink($request->only('email'));

        return $notificationStatus === Password::RESET_LINK_SENT
            ? back()->with(['notificationStatus' => __($notificationStatus)])
            : back()->withErrors(['email' => __($notificationStatus)]);
    }

    /**
     * Show the form for reseting the password.
     */
    public function edit(Request $request): InertiaView
    {
        return inertia('CP/Auth/PasswordReset/Reset', [
            'email' => $request->email,
            'token' => $request->route('token')
        ]);
    }

    /**
     * Update the password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', RulesPassword::defaults(), 'confirmed'],
        ]);

        $resetStatus = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $resetStatus === Password::PASSWORD_RESET
            ? redirect()->route('cp.auth.show')->with(['resetStatus' => __($resetStatus)])
            : back()->withErrors(['resetError' => __($resetStatus)]);
    }
}
