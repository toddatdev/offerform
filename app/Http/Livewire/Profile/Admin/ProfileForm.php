<?php

namespace App\Http\Livewire\Profile\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileForm extends Component
{
    use WithFileUploads;
    use PasswordValidationRules;

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
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Check route is.
     *
     * @var mixed
     */
    public $routeIs;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;

        $this->state = $user->withoutRelations()->toArray();

        if (request()->routeIs('dash.settings')) {
            $this->routeIs = 'settings';
        } elseif (request()->routeIs('dash.users.create')) {
            $this->routeIs = 'create';
        } else {
            $this->routeIs = 'edit';
        }
    }

    /**
     * Update the user's profile information.
     *
     * @param \Laravel\Fortify\Contracts\UpdatesUserProfileInformation $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $input = $this->state;

        if ($this->photo) {
            $input = array_merge($this->state, ['photo' => $this->photo]);
        }

        $updater->update(
            $this->user,
            $input
        );

        $this->emit('saved');
    }

    /**
     * Update the user's profile information.
     *
     * @return void
     */
    public function createUser()
    {
        $this->resetErrorBag();

        $input = $this->state;

        if ($this->photo) {
            $input = array_merge($this->state, ['photo' => $this->photo]);
        };

        Validator::make($input, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['nullable', 'string', 'unique:users'],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
                'other_inputs.admin_title' => ['required', 'string', 'max:100'],
                'password' => ['required', 'string', 'min:8'],
            ])->validateWithBag('createUser');


        $this->user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'other_inputs' => $input['other_inputs'] ?? [],
        ])->save();


        if (isset($input['photo'])) {
            $this->user->updateProfilePhoto($input['photo']);
        }

        $this->user->assignRole('admin');

        $this->user->sendEmailVerificationNotification();

        $this->redirect(route('dash.users.edit', $this->user->id));
    }

    /**
     * Render the component.
     *
     * @return mixed
     */
    public function render()
    {
        $users = User::where('id', '<>', auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->where('name', '<>', 'agent');
            })
            ->where('id', "<>", $this->user->id)
            ->paginate(100);
        return view('profile.admin.profile-form', compact('users'));
    }
}
