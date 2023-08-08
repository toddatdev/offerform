<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Fortify\UpdateUserSocialMediaLinks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateUserSocialMediaLinksForm extends Component
{
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
        $this->state = $this->user->links ?? [];
    }

    /**
     * Update the user's profile information.
     *
     * @param UpdateUserSocialMediaLinks $updater
     * @return void
     */
    public function update(UpdateUserSocialMediaLinks $updater)
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
        return view('profile.update-user-social-media-links-form');
    }
}
