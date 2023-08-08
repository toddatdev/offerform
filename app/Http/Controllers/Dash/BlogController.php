<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Pages\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('dash.cms.pages.blog', compact('blogs'));
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

            $blog = $request->all();

            $blog['slug'] = Str::slug($request->title);

            if ($request->hasFile('image')) {

                $blog['image'] = $request->file('image')->store('blog', 'public');
            }

            auth()->user()->blogs()->save(new Blog($blog));

            return redirect()->route('dash.blogs.index')->with('success', 'Blog created successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.blogs.index')->with('error', 'Some error with your submission');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('dash.cms.pages.blog', compact('blog'));
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

            $blogs = Blog::findOrFail($id);

            $blog = $request->all();

            $blog['slug'] = Str::slug($request->title);

            if ($request->hasFile('image')) {

                $blog['image'] = $request->file('image')->store('blog', 'public');
            }

            $blogs->update($blog);

            return redirect()->route('dash.blogs.index')->with('success', 'Blog Updated successfully');

        } catch (\Exception $exception) {

            return redirect()->route('dash.blogs.index')->with('error', 'Some error with your submission');

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
        Blog::find($id)->delete();

        return redirect()->route('dash.blogs.index')->with('error', 'Blog Deleted successfully');
    }
}
