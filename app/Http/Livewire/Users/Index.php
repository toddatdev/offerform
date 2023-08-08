<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
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
    public $limitPerPage = 100;

    /**
     * @var string[]
     */
    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function render()
    {
        $users = User::where('id', '<>', auth()->user()->id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'agent');
            })
            ->where(function ($query) {
                $query->where('first_name', 'LIKE', "%$this->search%")
                    ->orWhere('last_name', 'LIKE', "%$this->search%");
            })
            ->paginate($this->limitPerPage);
        return view('livewire.users.index', compact('users'));
    }

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 100;
    }

    public function loginAs(User $user) {
        Cookie::queue('login_back', auth()->user()->id, 15);
        \Auth::login($user);
        $this->redirect(route('dash.settings'));
    }
}
