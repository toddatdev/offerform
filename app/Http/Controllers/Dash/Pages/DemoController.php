<?php

namespace App\Http\Controllers\Dash\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Demo;
use App\Models\User;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $demos = Demo::all();

        return view('dash.cms.pages.demo', compact('demos', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $demo = $request->all();

            if ($request->hasFile('video')) {

                $demo['video'] = $request->file('video')->store('demos', 'public');
            }

            auth()->user()->demos()->save(new Demo($demo));

            return redirect()->route('dash.demos.index')->with('success', 'Demo created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.demos.index')->with('error', 'Some error with your submission');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $demos = Demo::findOrFail($id);

            $demo = $request->all();

            if ($request->hasFile('video')) {

                $demo['video'] = $request->file('video')->store('demos', 'public');

            }else{
                unset($demo['video']);
            }

            $demos->update($demo);

//            auth()->user()->demos()->save(new Demo($demo));

            return redirect()->route('dash.demos.index')->with('success', 'Demo Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.demos.index')->with('error', 'Some error with your submission');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Demo::find($id)->delete();

        return redirect()->route('dash.demos.index')->with('error', 'Demo Deleted successfully');
    }
}
