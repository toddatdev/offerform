<?php

namespace Database\Seeders;

use App\Models\Pages\Home;
use App\Models\Pages\LandingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPage::insert([
            [
                'hero_title' => 'Transforming the Realtor-Client relationship though',
                'hero_sub_title' => 'Video education',
                'hero_description' => 'Streamlining the offer process while ensuring all home buyers have a fair and equal opportunity to buy a home.',
                'hero_image' => 'v1.1/images/header-bg.png',
                'hero_video_link' => null,

                'sec_one_step_first_title' => 'Diversity and Inclusion...',
                'sec_one_step_first_desc' => 'Ensure all clients are asked the same questions and given the same opportunities.',
                'sec_one_step_first_image' => 'v1.1/images/looping.png',
                'sec_one_step_first_video' => null,

                'sec_one_step_second_title' => 'Meet the needs of any clients...',
                'sec_one_step_second_desc' => 'Forms in multiple languages, and easy accessibility for clients with different needs.',
                'sec_one_step_second_image' => 'v1.1/images/looping.png',
                'sec_one_step_second_video' => null,

                'sec_one_step_third_title' => 'Your business your branding',
                'sec_one_step_third_desc' => 'Create unique questions for your market with your custom branding',
                'sec_one_step_third_image' => 'v1.1/images/looping.png',
                'sec_one_step_third_video' => null,

                'sec_one_step_fourth_title' => 'Compliance',
                'sec_one_step_fourth_desc' => 'Use standardized forms to ensure no question is missed by consumers resulting in fewer E&O claims.',
                'sec_one_step_fourth_image' => 'v1.1/images/looping.png',
                'sec_one_step_fourth_video' => null,

                'sec_one_step_fifth_title' => 'Get more offers accepted...',
                'sec_one_step_fifth_desc' => 'Easily explain advanced offer strategies such as appraisal gaps, escalation clauses & seller rent backs.',
                'sec_one_step_fifth_image' => 'v1.1/images/looping.png',
                'sec_one_step_fifth_video' => null,

                'how_it_works_title' => 'How it Works',

                'sec_two_step_first_title' => 'Send a Link',
                'sec_two_step_first_desc' => 'Send your buyer your OfferForm link VIA text, email or copy the link to your website.',
                'sec_two_step_first_image' => 'v1.1/images/mobile-images.png',

                'sec_two_step_second_title' => 'Buyer fills out form',
                'sec_two_step_second_desc' => 'Buyer fills out a personalized OfferForm and gets educated through short form videos, a mortgage caclulator, and a closing cost calculator.',
                'sec_two_step_second_image' => 'v1.1/images/mobile-img-2.png',

                'sec_two_step_third_title' => 'Agent review',
                'sec_two_step_third_desc' => 'Completed OfferForms can be downloaded as a PDF, emailed to the listing agent, or exported to a CRM or Transaction Management tool.',
                'sec_two_step_third_image' => 'v1.1/images/mobile-1.png',

            ],
        ]);
    }
}
