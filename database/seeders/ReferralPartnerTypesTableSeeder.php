<?php

namespace Database\Seeders;

use App\Models\ReferralPartners\ReferralPartnerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReferralPartnerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferralPartnerType::insert([
            [
                'name' => 'Lender',
                'slug' => Str::slug('Lender'),
                'description' => null
            ],
            [
                'name' => 'Home Warranty',
                'slug' => Str::slug('Home Warranty'),
                'description' => null
            ],
            [
                'name' => 'CPA',
                'slug' => Str::slug('CPA'),
                'description' => null
            ],
            [
                'name' => 'Handyman',
                'slug' => Str::slug('Handyman'),
                'description' => null
            ],
            [
                'name' => 'Home Insurance',
                'slug' => Str::slug('Home Insurance'),
                'description' => null
            ],
        ]);
    }
}
