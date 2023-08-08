<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;


    protected $casts = [
        'features' => 'array',
    ];

    protected $fillable = [
        'title',
        'tagline',
        'features',
    ];


}
