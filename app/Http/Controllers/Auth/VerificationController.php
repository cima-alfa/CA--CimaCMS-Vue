<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Response as InertiaView;

class VerificationController extends Controller implements HasMiddleware
{
    /**
     * User verification notification timeout in minutes
     */
    private static $notifyTimeout = 1;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        $notifyTimeout = self::$notifyTimeout;

        return [
            new Middleware("throttle:1,{$notifyTimeout}", only: ['notify']),
        ];
    }

    /**
     * Show the user verification page.
     */
    public function create(): InertiaView
    {
        return inertia('CP/Auth/UserVerification', [
            'verificationStatus' => session('verificationStatus'),
            'notifyTimeout' => self::$notifyTimeout
        ]);
    }

    /**
     * Send the verification notice to the user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('verificationStatus', 'Verification link sent!');
    }

    /**
     * Verify the user.
     */
    public function update(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        // Redirect to Front or CMS user dashboard
        return redirect()->route('cp.dashboard.index');
    }
}
