<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;


    protected $fillable = [
        'hero_title',
        'hero_sub_title',
        'hero_description',
        'hero_image',
        'hero_video_link',

        'sec_one_step_first_title',
        'sec_one_step_first_desc',
        'sec_one_step_first_image',
        'sec_one_step_first_video',

        'sec_one_step_second_title',
        'sec_one_step_second_desc',
        'sec_one_step_second_image',
        'sec_one_step_second_video',

        'sec_one_step_third_title',
        'sec_one_step_third_desc',
        'sec_one_step_third_image',
        'sec_one_step_third_video',

        'sec_one_step_fourth_title',
        'sec_one_step_fourth_desc',
        'sec_one_step_fourth_image',
        'sec_one_step_fourth_video',

        'sec_one_step_fifth_title',
        'sec_one_step_fifth_desc',
        'sec_one_step_fifth_image',
        'sec_one_step_fifth_video',

        'how_it_works_title',
        'sec_two_step_first_title',
        'sec_two_step_first_desc',
        'sec_two_step_first_image',

        'sec_two_step_second_title',
        'sec_two_step_second_desc',
        'sec_two_step_second_image',

        'sec_two_step_third_title',
        'sec_two_step_third_desc',
        'sec_two_step_third_image',

    ];

}

