<?php

namespace Database\Seeders;

use App\Models\OfferForms\OfferForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OfferFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Standard Step Library OfferForm
        $stepLibrary = OfferForm::create([
            'source' => 'library',
            'slug' => 'standard-step-library',
            'name' => 'Admin Standard Step Library',
            'description' => 'Admin Standard Step Library OfferForm',
            'display_order' => 1,
            'active' => 1,
            'standard' => 1,
            'locked' => 0,
            'created_by_id' => 1,
        ]);

        // Default Steps Loading
        foreach (Storage::disk('local')->files('public/offer-forms/library') as $file) {
            $this->command->info($file);
            $offerForm = OfferForm::firstOrNew([
                'source' => 'library',
                'parent_id' => $stepLibrary->id,
                'image' => str_replace('public/', '', $file),
                'name' => Str::title(str_replace('-', ' ', pathinfo($file)['filename'])),
                'description' => Str::title(str_replace('-', ' ', pathinfo($file)['filename'])),
                'display_order' => 1,
                'active' => 0,
                'standard' => 1,
                'locked' => 1,
                'created_by_id' => 1,
            ]);
            if (!$offerForm->exists) {
                $offerForm->save();
            }
        }
    }
}
