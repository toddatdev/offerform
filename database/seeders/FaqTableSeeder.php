<?php

namespace Database\Seeders;

use App\Models\Pages\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::insert([
            [
                'title' => 'Why would I use OfferForm to gather offer information?',
                'description' => 'You’re spending hours gathering this info already, via text messaging, email, phone calls, or in person. OfferForm streamlines that whole proccess with a customizable form that can be sent to your clients to fill out on their own timeline. These forms can include short form videos recorded by you that explain key real estate terminology such as earnest money. Saving you time and making you look like a professional.',
            ],

            [
                'title' => 'Does the information move to my state form?',
                'description' => ' No, however it will in just a few months! For now, enjoy having all the data you need on our beautiful summary page to write an offer, use as a cover letter, or export VIA Zapier.',
            ],
            [
                'title' => 'What do I do after a form is complete?',
                'description' => 'You can send over the summary page to the listing agent, export the data to your other systems such as a CRM or Transaction Management System, or use Zapier to connect to over 1,000 apps. Or use it to prepare the state contract.',
            ],
            [
                'title' => ' Does it take me (The Agent) out of the transaction?',
                'description' => 'No! Your branding and contact info are on every page. Upload custom videos for a more personal touch with your clients.',
            ],
            [
                'title' => 'Will OfferForm work for my team, brokerage or association?',
                'description' => 'Yes OfferForm is fully customizable and can work in any state, country, or market.',
            ],
            [
                'title' => 'Will it work in my market or state?',
                'description' => 'Yes, OfferForm allows teams to share forms. Team leaders can manage members and see all completed forms.',
            ],

            [
                'title' => 'How do I send the form to my clients?',
                'description' => 'You can text, or email the form to your client right out of the system. Or copy and send a link any way you would like.',
            ],

            [
                'title' => 'Why is it free?',
                'description' => 'We have locked steps on our free plan. such as ones that asks your clients if they would like a FREE quote on homeowners insurance, and the second asks them if they would like information on a home warranty.',
            ],

            [
                'title' => 'Can I use it on my phone?',
                'description' => ' Yes it is mobile-ready. Use it on any device.',
            ],

        ]);
    }
}
