<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Pages\Blog;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function index()
    {
        return view('dash.cms.index');
    }

    public function about()
    {
        return view('dash.cms.pages.about');
    }

    public function testimonials()
    {
        return view('dash.cms.pages.testimonials');
    }

    public function pricingPackages()
    {
        return view('dash.cms.pages.pricing-packages');
    }

    public function contact()
    {
        return view('dash.cms.pages.contact');
    }

    public function demo()
    {
        return view('dash.cms.pages.demo');
    }

    public function home()
    {
        return view('dash.cms.pages.home');
    }

    public function blog()
    {
        $blogs = Blog::all();
        return view('dash.cms.pages.blog', compact('blogs'));

    }
}
