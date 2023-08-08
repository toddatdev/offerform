<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(){
        return view('agent.all-sections');
    }

    public function settings(){
        return view('agent.settings');
    }

    public function viewCompletedForm(){
        return view('agent.view-completed-form');
    }
}
