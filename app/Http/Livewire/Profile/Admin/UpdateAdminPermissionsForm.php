<?php

namespace App\Http\Livewire\Profile\Admin;

use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Spatie\Permission\Models\Permission;

class UpdateAdminPermissionsForm extends Component
{
    use PerformsRedirects;

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
    public function mount($user)
    {
        $this->user = $user;

        $this->state = $user->permissions()->pluck('id')->toArray();
    }

    /**
     * Save Permission.
     *
     * @return mixed
     */
    public function save()
    {
        $this->user->syncPermissions($this->state);

        $this->emit('saved');
    }


    public function activeOrInactive()
    {
        $this->user->active = !$this->user->active;
        $this->user->save();
        $this->user->fresh();
    }

    public function destroy()
    {
        $this->user->delete();

        $this->redirectRoute('dash.settings');
    }

    /**
     * Render the component.
     *
     * @return mixed
     */
    public function render()
    {
        $permissions = Permission::all();

        return view('profile.admin.update-admin-permissions-form', compact('permissions'));
    }
}
