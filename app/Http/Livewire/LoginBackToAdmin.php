<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class LoginBackToAdmin extends Component
{
    private ?User $user = null;
    public function mount() {

        $this->user = User::find(intVal(Cookie::get('login_back')));
//        dd($this->user);
    }
    public function render()
    {
        if (is_null($this->user)) return '';

        return <<<'blade'
            <div>
                <a
                    href="#"
                    class="bg-primary-light d-block text-decoration-none text-center text-white py-2"
                    wire:click.prevent="loginBack({{ $this->user->id }})"
                   >
                   Login back to <strong>Admin</strong>
               </a>
            </div>
        blade;
    }

    public function loginBack(User $user) {
        \Auth::login($user);
        Cookie::queue(Cookie::forget('login_back'));
        $this->redirect(route('dash.users.index'));
    }
}
