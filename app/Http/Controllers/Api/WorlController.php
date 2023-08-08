<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorlController extends Controller
{
    public function countries(Request $request)
    {
        return Country::where('name', 'like', "%" . $request->get('q', '') . "%")
            ->limit(50)
            ->get();
    }

    public function states(Request $request)
    {
        return State::where('name', 'like', "%" . $request->get('q', '') . "%")
            ->when($request->has('country_id'), function ($query) use ($request) {
                $query->where('country_id', $request->country_id);
            })
            ->limit(50)
            ->get();
    }

    public function cities(Request $request)
    {
        return City::where('name', 'like', "%" . $request->get('q', '') . "%")
            ->when($request->has('country_id'), function ($query) use ($request) {
                $query->where('country_id', $request->country_id);
            })
            ->when($request->has('state_id'), function ($query) use ($request) {
                $query->where('state_id', $request->state_id);
            })
            ->limit(50)
            ->get();
    }

    public function zipcodes(Request $request)
    {
        return DB::table('zipcodes')
            ->where('zipcode', 'like', "%" . $request->get('q', '') . "%")
            ->limit(50)
            ->get();
    }
}
