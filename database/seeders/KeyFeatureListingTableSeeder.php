<?php

namespace Database\Seeders;

use App\Models\Pages\KeyFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeyFeatureListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KeyFeature::insert([
            [
                'type' => 'Forms',
                'title' => 'Customizable forms',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Forms',
                'title' => 'Customizable Steps',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Forms',
                'title' => 'Text or email forms',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Forms',
                'title' => 'Pre-Fill and send',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Forms',
                'title' => 'Shared Forms',
                'tooltip' => null,
                'is_free' => '0',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Short Form video',
                'title' => 'Upload custom videos',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Short Form video',
                'title' => 'Video Bio',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Short Form video',
                'title' => 'Custom video message for each form',
                'tooltip' => null,
                'is_free' => '0',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Short Form video',
                'title' => 'Automatic subtitles',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Client Experience',
                'title' => 'Educational content',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Client Experience',
                'title' => 'Real time tools',
                'tooltip' => null,
                'is_free' => '1',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Client Experience',
                'title' => 'Multiple Languages',
                'tooltip' => null,
                'is_free' => '0',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],
            [
                'type' => 'Client Experience',
                'title' => 'Built in text to speech',
                'tooltip' => null,
                'is_free' => '0',
                'is_premium' => '1',
                'is_enterprise' => '1',
            ],

        ]);
    }
}
