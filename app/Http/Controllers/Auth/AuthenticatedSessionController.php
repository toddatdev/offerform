<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SocialProvider;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        $redirectTo = RouteServiceProvider::HOME;

        if ($user->hasRole('agent')) {
//            if (is_null($user->last_login_at)) {
//                $redirectTo = route('dash.settings', 'first');
//            } else {
                $redirectTo = route('dash.offer-forms.index');
//            }
        }

//        $user->last_login_at = now();
//        $user->save();

        return redirect()->intended($redirectTo);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function thirdPartyLoginInitialize($provider)
    {
        if (!(in_array($provider, ['google', 'facebook']) && config()->has("services.{$provider}"))) {
            return $this->sendFailedResponse("{$provider} is not currently supported");
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function thirdPartyLoginCallback($provider)
    {


        try {

            $providerUser = Socialite::driver($provider)->user();

            if (empty($providerUser->getEmail())) {
                return $this->sendFailedResponse("No email id returned from {$provider} provider.");
            }

            $user = User::where('email', $providerUser->getEmail())->first();

            if ($user) {
                $socialProvider = $user->socialProviders()
                    ->where([
                        'provider_id' => $providerUser->getId(),
                        'provider_name' => $provider
                    ])->first();

                if (!$socialProvider) {
                    $user->socialProviders()->save(new SocialProvider([
                        'provider_id' => $providerUser->getId(),
                        'provider_name' => $provider,
                    ]));
                }
            } else {

                $get_name = explode(" ", $providerUser->getName());

                $user = User::create([
                    'first_name' => $get_name[0],
                    'last_name' => $get_name[1],
                    'password' => Hash::make(Str::random(15)),
                    'email' => $providerUser->getEmail(),
                    'email_verified_at' => Carbon::now(),
                ]);

                $user->assignRole(Role::where('name', 'agent')->first());

                $user->socialProviders()->save(new SocialProvider([
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ]));
            }

            Auth::login($user, true);

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            abort(404);
//            dd($e->getMessage());
//            return $this->sendFailedResponse('Something went wrong please try again later!');
        }
    }

}
