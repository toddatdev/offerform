<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    /**
     * @var Team
     */
    public Team $team;

    /**
     * @var null
     */
    public $image = null;

    /**
     * @var array[]
     */
    protected $rules = [
        'team.name' => ['required'],
        'team.contact_name' => ['required'],
        'team.contact_email' => ['required'],
        'team.address' => ['required'],
        'team.contact_phone' => ['required'],
        'team.notes' => [],
        'team.no_of_agents' => [],
        'team.total_agents' => [],
        'team.price_per_agent' => [],
        'team.discount_per_month' => [],
        'team.discount_per_year' => [],
        'team.code' => [],
        'image' => [],
    ];

    /**
     * @param Team|null $team
     * @return void
     */
    public function mount($team = null)
    {
        if ($team) {
            $this->team = $team;
        } else {
            $this->team = new Team();
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.teams.form');
    }

    /**
     * @return void
     */
    public function onChangeImage()
    {
        if ($this->image) {
            $this->team->upload($this->image, 'image');
        }
    }

    /**
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->onChangeImage();

        if (!$this->team->code) {
            $this->team->code = strtoupper(str_replace(' ', '', $this->team->name) . substr(preg_replace("/\s+/", "", $this->team->contact_phone), -4));
        }

        if (!$this->team->personal_team) {
            $this->team->personal_team = false;
        }

        $this->team->save();

        $this->emit('showToast', 'Success!', 'Team has been saved successfully!');
    }
}
