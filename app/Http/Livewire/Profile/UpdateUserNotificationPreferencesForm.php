<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Fortify\UpdateUserNotificationPreferences;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use function view;

class UpdateUserNotificationPreferencesForm extends Component
{
    public $ownedTeam;
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->ownedTeam = $this->user->current_team_id ? $this->user->ownedTeams()->first() : null;

        $this->state = $this->user->notification_preferences ?? [];
    }

    /**
     * Update the user's profile information.
     *
     * @param UpdateUserNotificationPreferences $updater
     * @return void
     */
    public function update(UpdateUserNotificationPreferences $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->state);

        $this->emit('saved');
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
        return view('profile.update-user-notification-preferences-form');
    }
}
