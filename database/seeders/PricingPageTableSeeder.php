<?php

namespace Database\Seeders;

use App\Models\Pages\PricingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PricingPage::insert([
            [
                'title' => 'Association or Brokerage Owners',
                'description' => 'OfferForm features a lucrative revenue share option that allows associations and brokerage owners to earn money from their agents and members. Schedule a demo with us to see what that looks like for your organization.',
                'image' => 'pricing/mobile-image.svg',
            ],
        ]);
    }
}
