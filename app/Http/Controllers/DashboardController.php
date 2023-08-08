<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole(['super-admin', 'admin'])) {
            return redirect(route('dash.users.index'));
        } elseif(auth()->user()->hasRole('agent')) {
            return redirect(route('dash.offer-forms.index'));
        } else {
            return redirect(route('dash.offer-forms.completed'));
        }
    }

    public function settings(Request $request)
    {
        return view('dash.settings', [
            'user' => $request->user()
        ]);
    }

    public function clearNotifications() {
        auth()->user()->notifications()->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
