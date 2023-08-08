<?php

namespace App\Models\Pages;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'video'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
