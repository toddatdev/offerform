<?php

namespace App\Http\Controllers\dash\pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\KeyFeature;
use Illuminate\Http\Request;

class KeyFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if (!isset($request['is_free'])){
            $is_free =  '0';
        }else{
            $is_free =  $request['is_free'];
        }

        if (!isset($request['is_premium'])){
            $is_premium =  '0';
        }else{
            $is_premium =  $request['is_premium'];
        }

        if (!isset($request['is_enterprise'])){
            $is_enterprise =  '0';
        }else{
            $is_enterprise =  $request['is_enterprise'];
        }

        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'tooltip' => $request->tooltip,
            'is_free' => $is_free,
            'is_premium' => $is_premium,
            'is_enterprise' => $is_enterprise,
        ];

        $createKeyFeature = KeyFeature::create($data);

        return redirect()->route('dash.pricing.index')->with('success','Key Feature Created Successfully...');
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

        $keyFeatures = KeyFeature::findOrFail($id);

        if (!isset($request['is_free'])){
            $is_free =  '0';
        }else{
            $is_free =  $request['is_free'];
        }

        if (!isset($request['is_premium'])){
            $is_premium =  '0';
        }else{
            $is_premium =  $request['is_premium'];
        }

        if (!isset($request['is_enterprise'])){
            $is_enterprise =  '0';
        }else{
            $is_enterprise =  $request['is_enterprise'];
        }

        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'tooltip' => $request->tooltip,
            'is_free' => $is_free,
            'is_premium' => $is_premium,
            'is_enterprise' => $is_enterprise,
        ];

        $keyFeatures->update($data);

        return redirect()->route('dash.pricing.index')->with('success','Key Feature Updated Successfully...');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeyFeature $keyFeature)
    {
        $keyFeature->delete();

        return redirect()->route('dash.pricing.index')->with('error','Key Feature Deleted Successfully');

    }
}
