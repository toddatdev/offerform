<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFeatureTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
