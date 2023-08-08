<?php

namespace App\Http\Livewire\Profile\Agent;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;

class IntegrationsForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The user.
     *
     * @var array
     */
    public ?User $user;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;

        if ($user) {
            $this->state = $user->integrations ?? [];
        }
    }

    /**
     * Update integrations
     *
     * @return void
     */
    public function update()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'zapier' => ['nullable', 'active_url'],
        ]);

        $this->user->integrations = array_filter($this->state);

        $this->user->save();

        $this->emit('integrations-updated');
    }

    public function render()
    {
        return view('profile.agent.integrations-form');
    }
}
