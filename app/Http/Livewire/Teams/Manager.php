<?php

namespace App\Http\Livewire\Teams;

use App\Actions\Jetstream\InviteTeamMember;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use App\Contracts\InvitesTeamMembers;
use Laravel\Jetstream\Features;
use Livewire\Component;

class Manager extends Component
{
    public Team $team;

    public $search;

    public $addTeamMemberForm = [
        'name' => '',
        'email' => ''
    ];

    public function mount($code)
    {
        $team = Team::where('code', $code)->first();

        abort_if(!$team, 404);

        $this->team = $team;
    }

    public function render()
    {
        return view('livewire.teams.manager');
    }

    public function inviteTeamMember()
    {
        $this->resetErrorBag();

        if (Features::sendsTeamInvitations()) {
            app(InvitesTeamMembers::class)->invite(
                $this->user,
                $this->team,
                $this->addTeamMemberForm['name'],
                $this->addTeamMemberForm['email'],
                'editor'
            );
        } else {
            app(AddsTeamMembers::class)->add(
                $this->user,
                $this->team,
                $this->addTeamMemberForm['email'],
                'editor'
            );
        }

        $this->addTeamMemberForm = [
            'name' => '',
            'email' => '',
        ];

        $this->team = $this->team->fresh();

        $this->emit('showToast', 'Success!', 'Invitation to join team has been sent successfully.');
        $this->emit('hideModal');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $this->team->removeUser($user);
            $this->emit('hideModal');
            $this->emit('showToast', 'Success!', 'Agent removed successfully from team.');
        }
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }
}
