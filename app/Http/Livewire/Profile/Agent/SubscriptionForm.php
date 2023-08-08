<?php

namespace App\Http\Livewire\Profile\Agent;

use App\Models\Team;
use App\Models\User;
use App\Notifications\NewTeamAccount as NewTeamAccountNotification;
use Illuminate\Support\Str;
use Livewire\Component;
use Stripe\SetupIntent;

class SubscriptionForm extends Component
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
     * Team to associate with team.
     *
     * @var array
     */
    public $teamCode;


    public $plan = [];

    public $paymentMethod;
    public $billing = [];

    public $clientSecret;
    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;
        $this->clientSecret = $this->user->createSetupIntent()->client_secret;

//        if ($user->hasPaymentMethod()) {
//            $this->paymentMethod = $user->defaultPaymentMethod();
//        }
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

        foreach ($this->user->subscriptions as $subscription) {
            if (!$subscription->canceled()) {
                $subscription->cancel();
            }
        }

        $plan = "{$this->plan['name']}-{$this->plan['type']}-{$this->plan['per']}ly";
        $this
            ->user
            ->newSubscription($plan, User::SUBSCRIPTION_STRIPE_PLANS[$plan])
            ->create($this->paymentMethod);

        if ($this->plan['type'] === 'team') {
            $team = $this->user->ownedTeams()->first();
            if (!$team) {
                $this->user->ownedTeams()->save($team = new Team([
                    'name' => $this->user->other_inputs['team_name'] ?? $this->user->full_name,
                    'user_id' => $this->user->id,
                    'code' => strtoupper(str_replace(' ', '', $this->user->other_inputs['team_name'] ??  $this->user->full_name) .  substr(preg_replace("/\s+/", "", $this->user->phone ?? rand(10000, 20000)), -4)),
                    'no_of_agents' => 30,
                    'contact_name' => $this->user->full_name,
                    'contact_email' => $this->user->email,
                    'contact_phone' => $user->phone ?? rand(10000, 20000),
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
            if (!$subscription->canceled()) {
                $subscription->cancel();
            }
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
                    'name' => $this->user->other_inputs['team_name'] ?? $this->user->full_name,
                    'user_id' => $this->user->id,
                    'code' => strtoupper(str_replace(' ', '',$this->user->other_inputs['team_name'] ?? $this->user->full_name) . substr(preg_replace("/\s+/", "", $this->user->phone ?? rand(10000, 20000)), -4)),
                    'no_of_agents' => 30,
                    'contact_name' => $this->user->full_name,
                    'contact_email' => $this->user->email,
                    'contact_phone' => $user->phone ?? rand(10000, 20000),
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

    /**
     * Render the component.
     *
     * @return mixed
     */
    public function render()
    {
        return view('profile.agent.subscription-form');
    }
}
