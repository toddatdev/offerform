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
        Schema::create('offer_form_referral_partner_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_form_id')->constrained()->index('of_rpt_offer_form_id')->onDelete('cascade');
            $table->foreignId('referral_partner_type_id')->constrained()->index('of_rpt_referral_partner_type_id')->onDelete('cascade');
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
        Schema::dropIfExists('offer_form_referral_partner_type');
    }
};
