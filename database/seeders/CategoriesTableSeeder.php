<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
                    'categories/key-offer-terms.svg' => 'Key Offer Terms',
                    'categories/offer-dates.svg' => 'Offer Dates',
                    'categories/financial-terms.svg' => 'Financial Terms',
                    'categories/contingency-terms.svg' => 'Contingency Terms',
                    'categories/closing-cost-terms.svg' => 'Closing Cost Terms',
                    'categories/title-and-escrow-terms.svg' => 'Title and Escrow Terms',
                    'categories/home-warranty-terms.svg' => 'Home Warranty Terms',
                    'categories/personal-property-terms.svg' => 'Personal Property Terms',
                    'categories/seller-rent-bank-terms.svg' => 'Seller Rent Back Terms',
                    'categories/septic-terms.svg' => 'Septic Terms',
                    'categories/well-terms.svg' => 'Well Terms',
                    'categories/not-categorized.svg' => 'Closing Date',
                 ] as $key => $category) {
            $category = Category::firstOrNew([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);

            if (!$category->exists) {
                $category->fill([
                    'image' => $key,
                ])->save();
            }
        }
    }
}
