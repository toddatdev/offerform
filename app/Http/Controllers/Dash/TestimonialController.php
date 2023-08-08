<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $testimonials = Testimonial::all();

        return view('dash.cms.pages.testimonials', compact('testimonials'));
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

            $testimonial = $request->all();

            if ($request->hasFile('image')) {

                $testimonial['image'] = $request->file('image')->store('testimonials', 'public');
            }

            if ($request->hasFile('video')) {

                $testimonial['video'] = $request->file('video')->store('testimonials', 'public');
            }

            Testimonial::create($testimonial);

            return redirect()->route('dash.testimonials.index')->with('success', 'Testimonial created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.testimonials.index')->with('error', 'Some error with your submission');

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
        $blog = Testimonial::findOrFail($id);
        return view('dash.cms.pages.testimonials', compact('blog'));
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
            $testimonails = Testimonial::findOrFail($id);

            $testimonail = $request->all();

            if ($request->hasFile('image')) {
                $testimonail['image'] = $request->file('image')->store('testimonial', 'public');
            } else {
                unset($testimonail['image']);
            }

            if ($request->hasFile('video')) {

                $testimonial['video'] = $request->file('video')->store('testimonials', 'public');
            }else {
                unset($testimonail['video']);
            }

            $testimonails->update($testimonail);

            return redirect()->route('dash.testimonials.index')->with('success', 'Testimonial Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('testimonials.index')->with('error', 'Error in your system');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Testimonial::find($id)->delete();

        return redirect()->route('dash.testimonials.index')->with('error', 'Testimonial Deleted successfully');
    }
}
