<?php

namespace Database\Seeders;

use App\Models\Pages\KeyFeatureTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeyFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KeyFeatureTypes::insert([
            [
                'name' => 'Forms',
            ],
            [
                'name' => 'Short Form video	',
            ],
            [
                'name' => 'Client Experience	',
            ],
        ]);
    }
}
