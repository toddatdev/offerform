<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_title')->nullable();
            $table->string('hero_sub_title')->nullable();
            $table->longText('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_video_link')->nullable();

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

            $table->string('sec_one_step_fifth_title')->nullable();
            $table->longText('sec_one_step_fifth_desc')->nullable();
            $table->string('sec_one_step_fifth_image')->nullable();
            $table->string('sec_one_step_fifth_video')->nullable();


            $table->string('sec_two_step_first_title')->nullable();
            $table->longText('sec_two_step_first_desc')->nullable();
            $table->string('sec_two_step_first_image')->nullable();

            $table->string('sec_two_step_second_title')->nullable();
            $table->longText('sec_two_step_second_desc')->nullable();
            $table->string('sec_two_step_second_image')->nullable();

            $table->string('sec_two_step_third_title')->nullable();
            $table->longText('sec_two_step_third_desc')->nullable();
            $table->string('sec_two_step_third_image')->nullable();

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
        Schema::dropIfExists('landing_pages');
    }
};
