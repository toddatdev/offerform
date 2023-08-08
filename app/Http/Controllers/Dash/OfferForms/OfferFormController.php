<?php

namespace App\Http\Controllers\Dash\OfferForms;

use App\Http\Controllers\Controller;
use App\Models\OfferForms\OfferForm;
use App\Models\OfferForms\OfferFormOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

class OfferFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view('dash.offer-forms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $this->authorize('create', OfferForm::class);
        return view('dash.offer-forms.create-or-update');
    }


    /**
     * Display the specified resource.
     *
     * @param OfferForm $offerForm
     * @param OfferForm $offerFormStep
     * @return mixed
     */
//    public function show(OfferForm $offerForm, OfferForm $offerFormStep)
//    {
//        return view('dash.offer-forms.steps.index', compact('offerForm', 'offerFormStep'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OfferForm $offerForm
     * @return mixed
     */
    public function edit(OfferForm $offerForm)
    {
        $this->authorize('update', $offerForm);
        return view('dash.offer-forms.create-or-update', compact('offerForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OfferForm $offerForm
     * @return mixed
     */
//    public function stepEdit(OfferForm $offerForm, OfferForm $offerFormStep)
//    {
//        return view('dash.offer-forms.steps.create-or-edit', compact('offerForm', 'offerFormStep'));
//    }

    public function exportCompletedFormToPDF(OfferFormOffer $offerFormOffer)
    {
        return $offerFormOffer->toPdf()->download("$offerFormOffer->slug.pdf");
//        return $offerFormOffer->toPdf()->inline();
    }
}
