<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();

//          Hero section
            $table->string('hero_title')->nullable();
            $table->string('hero_short_description')->nullable();
            $table->longText('hero_description')->nullable();
            $table->string('hero_bottom_description')->nullable();
            $table->string('hero_image')->nullable();

             //Here’s what we do in 60 seconds
            $table->string('section_one_title')->nullable();
            $table->string('section_one_video_link')->nullable();

            //How it Works
            $table->string('how_it_works_title')->nullable();
            $table->string('sec_one_step_first_title')->nullable();
            $table->longText('sec_one_step_first_desc')->nullable();
            $table->string('sec_one_step_first_image')->nullable();
            $table->string('sec_one_step_first_video')->nullable();

            $table->string('sec_one_step_second_title')->nullable();
            $table->longText('sec_one_step_second_desc')->nullable();
            $table->string('sec_one_step_second_image')->nullable();
            $table->string('sec_one_step_second_video')->nullable();

            $table->string('sec_one_step_third_title')->nullable();
            $table->longText('sec_one_step_third_desc')->nullable();
            $table->string('sec_one_step_third_image')->nullable();
            $table->string('sec_one_step_third_video')->nullable();

            $table->string('sec_one_step_fourth_title')->nullable();
            $table->longText('sec_one_step_fourth_desc')->nullable();
            $table->string('sec_one_step_fourth_image')->nullable();
            $table->string('sec_one_step_fourth_video')->nullable();

//            Used by These Top Brokerages
            $table->string('brokerage_title')->nullable();
            $table->string('brokerage_first_image')->nullable();
            $table->string('brokerage_second_image')->nullable();
            $table->string('brokerage_third_image')->nullable();
            $table->string('brokerage_fourth_image')->nullable();

//            Why Agent’s Use OfferForm
            $table->string('agent_title')->nullable();
            $table->string('agent_sec_first_icon')->nullable();
            $table->string('agent_sec_first_title')->nullable();
            $table->longText('agent_sec_first_des')->nullable();
            $table->string('agent_sec_first_image')->nullable();

            $table->string('agent_sec_second_icon')->nullable();
            $table->string('agent_sec_second_title')->nullable();
            $table->longText('agent_sec_second_des')->nullable();
            $table->string('agent_sec_second_image')->nullable();

            $table->string('agent_sec_third_icon')->nullable();
            $table->string('agent_sec_third_title')->nullable();
            $table->longText('agent_sec_third_des')->nullable();
            $table->string('agent_sec_third_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homes');
    }
};
