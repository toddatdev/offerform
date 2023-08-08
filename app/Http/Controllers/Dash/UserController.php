<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('dash.users.index');
    }

    public function create()
    {
        return view('dash.users.create-or-update', [
            'user' => new User(),
        ]);
    }

    public function edit(User $user)
    {
        return view('dash.users.create-or-update', [
            'user' => $user
        ]);
    }
}
