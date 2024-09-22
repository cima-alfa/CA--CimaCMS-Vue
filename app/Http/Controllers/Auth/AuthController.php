<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Username;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Inertia\Response as InertiaView;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new user.
     */
    public function create(): InertiaView
    {
        return inertia('CP/Auth/Register');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'username' => Str::lower($request->username),
            'email' => Str::lower($request->email),
        ]);

        $credentials = $request->validate([
            'username' => ['required', 'min:4', 'max:32', new Username, 'unique:users'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = User::create($credentials);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    /**
     * Show the form for signing in a user.
     */
    public function show(): InertiaView
    {
        return inertia('CP/Auth/Login', [
            'resetStatus' => session('resetStatus')
        ]);
    }

    /**
     * Authenticate the specified user.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->merge([
            'login' => Str::lower($request->login),
        ]);

        $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::whereAny(
            ['username', 'email'],
            $request->login,
        )->first(['email']);

        $credentials = [
            'email' => $user?->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('cp.dashboard', absolute: false));
        }

        return back()->withErrors([
            'authError' => __('auth.failed'),
        ])->onlyInput('login', 'remember');
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('cp.auth.show');
    }
}
