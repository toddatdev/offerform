<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSubmittedSection;
use App\Models\Pages\About;
use App\Models\Pages\Faq;
use App\Models\Pages\Home;
use App\Models\Pages\LandingPage;
use App\Models\Pages\PricingPlan;
use App\Models\Pages\TermAndCondition;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class GuestController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('active', 1)->get();
        $homes = LandingPage::first();
        return view('welcome', compact('testimonials', 'homes'));

    }

    public function pricing()
    {
        $faqs = Faq::all();
        $pricingPlanCards = PricingPlan::all();
        return view('pricing',compact('faqs','pricingPlanCards'));
    }

    public function about()
    {
        $abouts = About::all();
        return view('about', compact('abouts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function demo()
    {
        $user = User::where('email', 'Mark@offerform.com')->first();

        return view('demo', compact('user'));
    }

    public function termsAndConditions()
    {
        $termsAndConditions = TermAndCondition::first();

        return view('terms-and-conditions', compact('termsAndConditions'));
    }

    public function blog()
    {
        $blogs = Blog::where('active', 1)->get();

        return view('blog.index', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('blog.blog-details', compact('blog'));
    }

    /**
     * Offer Form for Guest to submit.
     *
     * @param OfferForm $offerForm
     * @param OfferForm $offerFormStep
     * @return mixed
     */
    public function offerForm(OfferForm $offerForm, OfferForm $offerFormStep)
    {
        if (\request()->hasValidSignature()) {
            dd('ok');
        }
        return view('dash.offer-forms.steps.index', compact('offerForm', 'offerFormStep'));
    }

    /**
     * Submit Guest Offer Form.
     *
     * @param OfferForm $offerForm
     * @param OfferForm $offerFormStep
     * @return mixed
     */
    public function submitOfferForm(Request $request, OfferForm $offerForm, OfferForm $offerFormStep)
    {
        $formData = Cookie::get($offerForm->slug);

        if ($formData) {
            $formData = json_decode($formData, true);

            foreach ($formData as $key => $data) {
                $offerFormSection = OfferFormSection::find($key);
                if ($offerFormSection) {
                    $offerFormSubmittedSection = new OfferFormSubmittedSection(Arr::except($offerFormSection->toArray(), ['id', 'slug', 'active', 'go_to_the_next']));
                    $offerFormSubmittedSection->offer_form_section_id = $offerFormSection->id;
                    $offerFormSubmittedSection->user_response = $data;
                    $offerFormSubmittedSection->user_id = 1;
                    $offerFormSubmittedSection->save();
                }
            }
        }

        return 'Submitted Successfully';
    }

    public function exportCompletedFormToPDF(OfferFormOffer $offerFormOffer)
    {
        return $offerFormOffer->toPdf()->inline();
    }
}
