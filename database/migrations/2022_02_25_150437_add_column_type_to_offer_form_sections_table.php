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
        Schema::table('offer_form_sections', function (Blueprint $table) {
            $table->string('type')->after('title'); // inputs, display-text, image, video, cost-calculator, mortgage-calculator, seller-financing
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_form_sections', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
};
