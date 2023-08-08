<?php

namespace Database\Seeders;

use App\Models\Pages\PricingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PricingPlan::insert([
            [
                'title' => 'Free',
                'tagline' => '100% Free',
                'features' => json_encode(["Unlimited OfferForms", "Customizable Forms", "Educational Videos", "Record your own videos", "Text or Email the OfferForm"]),
            ],
            [
                'title' => 'Premium',
                'tagline' => 'Free plan features, plus:',
                'features' => json_encode(["Unlock Steps", "Mulitlingual Forms", "Accessibility Features", "Additional Form Types", "Team/Brokerage Form Sharing"]),
            ],
            [
                'title' => 'Enterprise',
                'tagline' => 'Free plan features and Premium Features:',
                'features' => json_encode(["Revenue Share", "Custom forms for all members", "Member Analytics"]),
            ],

        ]);
    }
}
