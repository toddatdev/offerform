<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','title','tooltip', 'description','is_free','is_premium','is_enterprise'
    ];

}
