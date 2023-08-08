<?php

namespace App\Http\Controllers\Dash\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\About;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function GuzzleHttp\Promise\all;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();

        return view('dash.cms.pages.about', compact('abouts'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {

            $about = $request->all();

            if ($request->hasFile('image')) {

                $about['image'] = $request->file('image')->store('abouts', 'public');
            }

            About::create($about);

            return redirect()->route('dash.about.index')->with('success', 'About us Information created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.about.index')->with('error', 'Some error with your submission');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $abouts = About::findOrFail($id);

            $about = $request->all();

            if ($request->hasFile('image')) {
                $about['image'] = $request->file('image')->store('abouts', 'public');
            } else {
                unset($about['image']);
            }

            $abouts->update($about);

            return redirect()->route('dash.about.index')->with('success', 'About us Information Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.about.index')->with('error', 'Error in your system');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            About::find($id)->delete();

            return redirect()->route('dash.about.index')->with('error', 'About us Information Deleted successfully');
        }
    }
}
