<?php

namespace App\Http\Controllers\Dash\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Home;
use App\Models\Pages\LandingPage;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.N
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = LandingPage::first();

        return view('dash.cms.pages.home', compact('homes'));
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

            $home = $request->all();


            foreach ([

                     'hero_image',
                     'hero_video_link',
                     'sec_one_step_first_image',
                     'sec_one_step_first_video',
                     'sec_one_step_second_image',
                     'sec_one_step_second_video',
                     'sec_one_step_third_image',
                     'sec_one_step_third_video',
                     'sec_one_step_fourth_image',
                     'sec_one_step_fourth_video',
                     'sec_one_step_fifth_image',
                     'sec_one_step_fifth_video',
                     'sec_two_step_first_image',
                     'sec_two_step_second_image',
                     'sec_two_step_third_image',

                     ] as $key) {
                if ($request->hasFile($key)) {
                    $home[$key] = $request->file($key)->store('landing-page', 'public');
                }
            }

            LandingPage::create($home);

            return redirect()->route('dash.home.index')->with('success', 'Landing Page setting created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.home.index')->with('error', 'Some error with your submission');

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

            $homes = LandingPage::findOrFail($id);

            $home = $request->all();

            foreach ([
                         'hero_image',
                         'hero_video_link',
                         'sec_one_step_first_image',
                         'sec_one_step_first_video',
                         'sec_one_step_second_image',
                         'sec_one_step_second_video',
                         'sec_one_step_third_image',
                         'sec_one_step_third_video',
                         'sec_one_step_fourth_image',
                         'sec_one_step_fourth_video',
                         'sec_one_step_fifth_image',
                         'sec_one_step_fifth_video',
                         'sec_two_step_first_image',
                         'sec_two_step_second_image',
                         'sec_two_step_third_image',

                     ] as $key) {
                if ($request->hasFile($key)) {
                    $home[$key] = $request->file($key)->store('landing-page', 'public');
                }else{
                    unset($home[$key]);
                }
            }

            $homes->update($home);

            return redirect()->route('dash.home.index')->with('success', 'Landing Page setting Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.home.index')->with('error', 'Some error with your submission');

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
