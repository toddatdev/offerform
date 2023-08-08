<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Http\Request;

class ReferralPartnerController extends Controller
{

    public function index(){

        return view('dash.referral-partners.index');

    }


    public function partnerList(){

        return view('dash.referral-partners.partner-list');

    }

    public function lenderAdvancedScreen(){

        return view('dash.referral-partners.lender-advance-screen');

    }


//    public function index(ReferralPartnerType $referralPartnerType)
//    {
//        return view('dash.referral-partners.index', compact('referralPartnerType'));
//    }
//
//    public function create(ReferralPartnerType $referralPartnerType)
//    {
//        return view('dash.referral-partners.create-or-update', compact('referralPartnerType'));
//    }
//    public function title()
//    {
//        return view('dash.referral-partners.title.index');
//    }
//
//    public function lender()
//    {
//        return view('dash.referral-partners.lender.index');
//    }
//
//    public function homeWarranty()
//    {
//        return view('dash.referral-partners.home-warranty.index');
//    }
//
//    public function homeInsurance()
//    {
//        return view('dash.referral-partners.home-insurance.index');
//    }
//
//    public function createOrUpdateTitle()
//    {
//        return view('dash.referral-partners.title.create-or-update');
//    }
//
//    public function createOrUpdateLender()
//    {
//        return view('dash.referral-partners.lender.create-or-update');
//    }
//
//    public function createOrUpdateHomeWarranty()
//    {
//        return view('dash.referral-partners.home-warranty.create-or-update');
//    }
//
//    public function createOrUpdateHomeInsurance()
//    {
//        return view('dash.referral-partners.home-insurance.create-or-update');
//    }

}
