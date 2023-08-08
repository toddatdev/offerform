<?php

namespace Database\Seeders;

use App\Models\Pages\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::insert([
            [
                'name' => 'Cody Tuma',
                'designation' => 'Co-Founder and CEO',
                'company_title' => 'OfferForm',
                'image' => 'img/about-img1.jpg',
                'content' => '
                <p>Hi, my name is Cody Tuma. I am a top producing agent in the Central Oregon market, as well as a team leader and principle broker. During the Real Estate boom of 2021 I found myself writing up to 20 offers per client, and getting majority of them rejected!</p>
                <p>After spending countless hours gathering offer information, explaining concepts such as earnest money and contingencies over and over again. I knew there had to be a better way!</p>
                <p>That’s when the idea for OfferForm was born. My Real Estate team now uses it all the time. It has saved us countless hours, while providing an exceptional and well received experience from our buyers. Their is now a better way for a better offer!</p>
                '
            ],

            [
                'name' => 'Mark Lumpkin',
                'designation' => 'Co-Founder',
                'company_title' => 'OfferForm',
                'image' => 'img/about-img1.jpg',
                'content' => '
                <p>Hi, my name is Cody Tuma. I am a top producing agent in the Central Oregon market, as well as a team leader and principle broker. During the Real Estate boom of 2021 I found myself writing up to 20 offers per client, and getting majority of them rejected!</p>
                <p>After spending countless hours gathering offer information, explaining concepts such as earnest money and contingencies over and over again. I knew there had to be a better way!</p>
                <p>That’s when the idea for OfferForm was born. My Real Estate team now uses it all the time. It has saved us countless hours, while providing an exceptional and well received experience from our buyers. Their is now a better way for a better offer!</p>
                '
            ],

        ]);
    }
}
