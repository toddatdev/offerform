<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserIfLoggedInFirstTime
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $shouldRedirect = false;

        if (auth()->check()) {
            $user = auth()->user();
            $user->fresh();

            if ($user->hasRole('agent') && $user->last_login_at === null && !is_null($user->email_verified_at)) {
                $shouldRedirect = true;
                $user->update(['last_login_at' => now()]);
                mailjet_send_email_by_template([
                    'Email' => $user->email,
                    'Name' => $user->full_name,
                ], 3995651, [
                ]);
            }
        }

        if ($shouldRedirect) {
            return redirect(route('dash.settings', 'first'));
        }
        return $next($request);
    }
}
