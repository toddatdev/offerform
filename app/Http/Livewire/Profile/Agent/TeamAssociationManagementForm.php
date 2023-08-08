<?php

namespace App\Http\Livewire\Profile\Agent;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeamAssociationManagementForm extends Component
{
    public $teamCode;
    /**
     * The component's state.
     *
     * @var array
     */
    public $associatedTeam;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->associatedTeam = $this->user->teams->first();
    }

    public function associateOrDisassociateWithTeam($type)
    {
        if ($type === 'associate') {
            $this->validate([
                'teamCode' => ['required', 'exists:teams,code'],
            ]);

            $team = Team::where('code', $this->teamCode)->first();

            if ($this->user->ownsTeam($team)) {
                $this->emit('showToast', 'Error!', "You can't associate with your own team.", 1);
                return;
            } elseif ($team) {
                $this->user->teams()->detach();
                $this->user->teams()->attach($team->id);
            }
        } elseif ($type === 'disassociate') {
            $teams = $this->user->teams;

            if (count($teams) > 0) {
                $this->user->teams()->detach($teams->pluck('id')->toArray());
            }
        }

        $this->associatedTeam = $this->user->teams()->first();

        $this->emit('showToast', 'Success!', "You have been successfully '{$type}' with team.");
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

    /**
     * Render the component.
     *
     * @return mixed
     */
    public function render()
    {
        return view('profile.agent.team-association-management-form');
    }
}
