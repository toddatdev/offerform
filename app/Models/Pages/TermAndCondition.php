<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermAndCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content',
    ];

}
