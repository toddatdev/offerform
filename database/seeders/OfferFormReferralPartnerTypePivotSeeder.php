<?php

namespace Database\Seeders;

use App\Models\OfferForms\OfferForm;
use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferFormReferralPartnerTypePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferralPartnerType::all()->each(function ($referralPartnerType) {
            $referralPartnerType->offerForms()->sync(1);
        });
    }
}
