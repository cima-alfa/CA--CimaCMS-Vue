<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirect control panel "foo" route to the closest existing route or to dashboard if non is found.
 * If no user is authenticated, redirect to login.
 */
class ControlPanelRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $this->handleRedirect($request) ?? $next($request);
    }

    private function handleRedirect(Request $request): ?RedirectResponse
    {
        if (($currentRouteName = Route::currentRouteName()) !== 'cp.' || Str::startsWith($currentRouteName, ['verification.', 'password.'])) {
            return null;
        }

        if (! Auth::check()) {
            return redirect()->route('cp.auth.login');
        }

        $routeCurrent = Route::current();
        $uriRegex = '/\/(?=[^\/]*$)/';
        $uri = ($foo = $routeCurrent->parameter('foo')) ? preg_split($uriRegex, $foo) : [];
        $redirect = 'cp.dashboard.index';
        
        if (count($uri) <= 1) {
            return redirect()->route($redirect);
        }

        $routes = Route::getRoutes();

        while ($uri) {
            $routeMatches = $routes->match(
                $request->create("{$routeCurrent->getPrefix()}/{$uri[0]}")
            );
            
            if ($routeMatches->getName() === 'cp.') {
                $uri = preg_split($uriRegex, $uri[0]);

                if (count($uri) <= 1) {
                    $uri = null;
                }

                continue;
            }

            $redirect = $routeMatches->getName();
            $uri = null;
        }
        
        return redirect()->route($redirect);
    }
}
