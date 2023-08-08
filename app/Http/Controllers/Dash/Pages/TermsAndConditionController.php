<?php

namespace App\Http\Controllers\Dash\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\TermAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $termsAndConditions = TermAndCondition::first();

        return view('dash.cms.pages.terms-and-conditions', compact('termsAndConditions'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {

            TermAndCondition::create($request->all());

            return redirect()->route('dash.terms-and-conditions.index')->with('success', 'created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.terms-and-conditions.index')->with('error', 'Some error with your submission');

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {

            $termsAndConditions = TermAndCondition::findOrFail($id);

            $termsAndConditions->update($request->all());

            return redirect()->route('dash.terms-and-conditions.index')->with('success', 'Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.terms-and-conditions.index')->with('error', 'Error in your system');

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
        //
    }
}
