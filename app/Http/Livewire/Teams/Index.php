<?php

namespace App\Http\Livewire\Teams;

use App\Models\Team;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Index extends Component
{
    /**
     * @var string
     */
    public $search = '';

    /**
     * @var int
     */
    public $limitPerPage = 6;

    /**
     * @var string
     */
    public $displayAs = 'grid';

    /**
     * @var string[]
     */
    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function mount()
    {
        $this->displayAs = Cookie::get('teams_display_as', 'grid');
    }

    public function render()
    {
        $teams = Team::where('name', 'LIKE', "%$this->search%")
            ->paginate($this->limitPerPage);
        return view('livewire.teams.index', compact('teams'));
    }

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 3;
    }

    /**
     * @return void
     */
    public function changeDisplayAs($as)
    {

        $this->displayAs = $as;

        Cookie::queue('teams_display_as', $as);
    }
}
