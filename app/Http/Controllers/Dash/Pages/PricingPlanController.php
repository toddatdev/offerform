<?php

namespace App\Http\Controllers\Dash\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Faq;
use App\Models\Pages\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricingPlans = PricingPlan::all();
        $faqs = Faq::all();

        return view('dash.cms.pages.pricing', compact('pricingPlans','faqs'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pricingPlan = PricingPlan::create($request->all());

        if ($pricingPlan){

            return redirect()->route('dash.pricing.index')->with('success', 'New Pricing Plan Created Successfully');

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
        $PricingPlan = PricingPlan::findOrFail($id);

//        dd($PricingPlan);

        $PricingPlan->update($request->all());

        return redirect()->route('dash.pricing.index')->with('success', 'Pricing Plan Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
