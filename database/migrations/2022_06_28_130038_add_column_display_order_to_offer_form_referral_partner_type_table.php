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
        Schema::table('offer_form_referral_partner_type', function (Blueprint $table) {
            $table->unsignedInteger('display_order')->default(100000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_form_referral_partner_type', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
    }
};
