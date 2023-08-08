<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Contracts\InvitesTeamMembers;
use Laravel\Jetstream\Events\InvitingTeamMember;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Mail\TeamInvitation;
use Laravel\Jetstream\Rules\Role;

class InviteTeamMember implements InvitesTeamMembers
{
    /**
     * Invite a new team member to the given team.
     *
     * @param mixed $user
     * @param mixed $team
     * @param string $email
     * @param string|null $role
     * @return void
     */
    public function invite($user, $team, string $name, string $email, string $role = null)
    {
        Gate::forUser($user)->authorize('addTeamMember', $team);

        $this->validate($team, $name, $email, $role);

        InvitingTeamMember::dispatch($team, $email, $role);

        $invitation = $team->teamInvitations()->create([
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ]);

        mailjet_send_email_by_template([
            'Email' => $email,
            'Name' => $name,
        ], 3791322, [
            'team_code' => $invitation->team->code,
            'team_name' => $invitation->team->name,
            'register_url' => route('register', [
                'code' => $invitation->team->code,
                'email' => $invitation->email,
                'name' => $invitation->name
            ]),
            'accept_url' => URL::signedRoute('team-invitations.accept', [
                'invitation' => $invitation,
            ])
        ]);

//        Mail::to($email)->send(new TeamInvitation($invitation));
    }

    /**
     * Validate the invite member operation.
     *
     * @param mixed $team
     * @param string $email
     * @param string|null $role
     * @return void
     */
    protected function validate($team, string $name, string $email, ?string $role)
    {
        Validator::make([
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ], $this->rules($team), [
            'email.unique' => __('This user has already been invited to the team.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTeam($team, $email)
        )->validateWithBag('addTeamMember');
    }

    /**
     * Get the validation rules for inviting a team member.
     *
     * @param mixed $team
     * @return array
     */
    protected function rules($team)
    {
        return array_filter([
            'name' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('team_invitations')->where(function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })],
            'role' => Jetstream::hasRoles()
                ? ['required', 'string', new Role]
                : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the team.
     *
     * @param mixed $team
     * @param string $email
     * @return \Closure
     */
    protected function ensureUserIsNotAlreadyOnTeam($team, string $email)
    {
        return function ($validator) use ($team, $email) {
            $validator->errors()->addIf(
                $team->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the team.')
            );
        };
    }
}
