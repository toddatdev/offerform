<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    public function index(){
        return view('form-builders.index');
    }
}
