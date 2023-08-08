<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use App\Notifications\NewTeamAccount as NewTeamAccountNotification;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileSetting extends Component
{
    use WithFileUploads;

    public $image = null;
    public $video = null;

    public $fname;
    public $lname;

    public $links = [];
    public $otherInputs = [];

    public $currentPassword;
    public $newPassword;

    public User $user;

    public $plan = [];

    public $paymentMethod;
    public $billing = [];

    public $teamCode;

    public $associatedTeam;

    protected $rules = [
        'user.email' => [],
        'user.phone' => [],
        'user.address' => [],
        'user.video' => [],
        'user.notification_preferences.email' => [],
        'user.notification_preferences.tc_email' => [],
        'user.notification_preferences.text' => [],
        'user.notification_preferences.user_email' => [],
        'user.notification_preferences.team' => [],
        'image' => [],
        'video' => [],
    ];

    public function mount()
    {
        $this->user = auth()->user();

        $flname = explode(',', $this->user->name);

        $this->fname = $flname[0] ?? '';
        $this->lname = $flname[1] ?? '';

        $this->links = $this->user->links ?: [];
        $this->otherInputs = $this->user->other_inputs ?: [];

        $this->associatedTeam = $this->user->teams()->first();
    }

    public function render()
    {
        return view('livewire.profile-setting');
    }

    public function onChangeProfile()
    {
        $this->user->name = $this->fname . ',' . $this->lname;

        $this->user->links = $this->links;
        $this->user->other_inputs = $this->otherInputs;

        $this->save();

        $this->emit('showToast', 'Success!', 'Profile updated successfully!');
    }

    public function onChangeImage()
    {
        if ($this->image) {
            $this->user->upload($this->image, 'image');
        }
    }

    public function changePassword()
    {
        $this->validate([
            'currentPassword' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, $this->user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'newPassword' => ['required'],
        ]);

        $this->user->password = \Hash::make($this->newPassword);
        $this->save();

        $this->emit('showToast', 'Success!', 'Password changed successfully!');
    }

    public function onChangeVideo()
    {
        if ($this->video) {
            $this->user->upload($this->video, 'video');
        }
    }

    public function onChangeNotificationPreferences()
    {

        $this->save();
        $this->emit('showToast', 'Success!', 'Profile notification preferences updated successfully!');
    }

    public function setPlanToSubscribe($name, $type, $per)
    {
        $this->plan = [
            'name' => $name,
            'type' => $type,
            'per' => $per,
        ];
    }

    public function upgradeToPremium()
    {
        $this->validate([
            'billing.full_name' => ['required'],
            'billing.address' => ['required'],
            'billing.city' => ['required'],
            'billing.zipcode' => ['required'],
            'billing.country' => ['required'],
            'billing.card_holder_name' => ['required'],
        ]);

        $plan = "{$this->plan['name']}-{$this->plan['type']}-{$this->plan['per']}ly";
        $this
            ->user
            ->newSubscription($plan, User::SUBSCRIPTION_STRIPE_PLANS[$plan])
            ->create($this->paymentMethod);

        if ($this->plan['type'] === 'team') {
            $team = $this->user->ownedTeams()->first();
            if (!$team) {
                $this->user->ownedTeams()->save($team = new Team([
                    'name' => $this->user->fullName,
                    'user_id' => $this->user->id,
                    'code' => Str::slug($this->user->fullName) . '-' . substr(preg_replace("/\s+/", "", $this->user->phone ?? '313231321321'), -4),
                    'no_of_agents' => 30,
                    'contact_name' => $this->user->fullName,
                    'contact_email' => $this->user->email,
                    'contact_phone' => $user->phone ?? '313231321321',
                    'address' => '-',
                    'personal_team' => false,
                ]));

                $this->user->notify(new NewTeamAccountNotification());
            }


            $this->user->current_team_id = $team->id;
            $this->user->save();
        }

        $this->emit('hideModal', true);
        $this->emit('showToast', 'Success!', "You have been successfully subscribed '{$this->plan['name']} {$this->plan['type']} {$this->plan['per']}ly'.");
    }

    public function downGradeToFree($type)
    {
        foreach ($this->user->subscriptions as $subscription) {
            $subscription->cancel();
        }

        if ($type === 'personal') {
            $team = $this->user->ownedTeams()->first();
            if ($team) {
                $this->user->current_team_id = null;
            }
            $this->user->save();
        }elseif ($type === 'team') {
            $team = $this->user->ownedTeams()->first();
            if (!$team) {
                $this->user->ownedTeams()->save($team = new Team([
                    'name' => $this->user->fullName,
                    'user_id' => $this->user->id,
                    'code' => Str::slug($this->user->fullName) . substr(preg_replace("/\s+/", "", $this->user->phone ?? '313231321321'), -4),
                    'no_of_agents' => 30,
                    'contact_name' => $this->user->fullName,
                    'contact_email' => $this->user->email,
                    'contact_phone' => $user->phone ?? '313231321321',
                    'address' => '-',
                    'personal_team' => false,
                ]));

                $this->user->notify(new NewTeamAccountNotification());
            }


            $this->user->current_team_id = $team->id;
            $this->user->save();
        }

        $this->emit('showToast', 'Success!', "You have been successfully subscribed '{$type} free' plan.");
    }

    public function associateOrDisassociateWithTeam($type) {

        if ($type === 'associate') {
            $this->validate([
                'teamCode' => ['required', 'exists:teams,code'],
            ]);

            $team = Team::where('code', $this->teamCode)->first();

            if ($this->user->ownsTeam($team)) {
                $this->emit('showToast', 'Error!', "You can't associate with your own team.", 1);
                return;
            }elseif ($team) {
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

    public function save()
    {
        $this->onChangeImage();
        $this->onChangeVideo();
        $this->user->save();
    }
}
