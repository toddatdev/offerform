<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_short_description',
        'hero_description',
        'hero_bottom_description',
        'hero_image',

        'section_one_title',
        'section_one_video_link',

        'how_it_works_title',
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

        'brokerage_title',
        'brokerage_first_image',
        'brokerage_second_image',
        'brokerage_third_image',
        'brokerage_fourth_image',

        'agent_title',
        'agent_sec_first_icon',
        'agent_sec_first_title',
        'agent_sec_first_des',
        'agent_sec_first_image',
        'agent_sec_second_icon',
        'agent_sec_second_title',
        'agent_sec_second_des',
        'agent_sec_second_image',
        'agent_sec_third_icon',
        'agent_sec_third_title',
        'agent_sec_third_des',
        'agent_sec_third_image',
    ];

}
