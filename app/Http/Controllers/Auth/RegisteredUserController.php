<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Notifications\NewTeamAccount as NewTeamAccountNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ];

        if ($request->as === 'agent') {
            $rules = array_merge($rules, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'brokerage_or_team_code' => ['nullable', 'string', 'max:255', 'exists:teams,code'],
            ]);
        } else {
            $rules = array_merge($rules, [
                'brokerage_or_team_name' => ['required', 'string', 'max:255'],
                'company_admin_name' => ['required', 'string', 'max:255'],
                'company_admin_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'company_admin_phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
                'no_of_agents' => ['required', 'numeric'],
                'your_position_with_company' => ['required', 'string', 'max:255'],
            ]);
        }

        $request->validate($rules);


        $user = User::create([
            'first_name' => $request->as === 'agent' ? $request->first_name : $request->company_admin_name,
            'last_name' => $request->as === 'agent' ? $request->last_name : $request->company_admin_name,
            'email' => $request->as === 'agent' ? $request->email : $request->company_admin_email,
            'phone' => $request->as === 'agent' ? null : $request->company_admin_phone,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(Role::where('name', 'agent')->first());

        if ($request->as === 'team') {
            $user->ownedTeams()->save($team = new Team([
                'name' => $request->brokerage_or_team_name,
                'code' => strtoupper(str_replace(' ', '', $request->brokerage_or_team_name) . substr(preg_replace("/\s+/", "", $request->company_admin_phone), -4)),
                'no_of_agents' => $request->no_of_agents,
                'contact_name' => $request->company_admin_name,
                'contact_email' => $request->company_admin_email,
                'contact_phone' => $request->company_admin_phone,
                'address' => '-',
                'personal_team' => false,
            ]));

            $user->other_inputs = ['team_name' => $team->name];
            $user->current_team_id = $team->id;
            $user->save();

            $user->notify(new NewTeamAccountNotification());
        } elseif ($request->brokerage_or_team_code !== null && $request->brokerage_or_team_code !== '') {
            $team = Team::where('code', $request->brokerage_or_team_code)->first();
            if ($team) {
                $user->teams()->attach($team->id);
                $user->other_inputs = ['team_name' => $team->name];
                $user->save();
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
