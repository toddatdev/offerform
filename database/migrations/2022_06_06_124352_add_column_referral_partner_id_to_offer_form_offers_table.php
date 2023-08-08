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
        Schema::table('offer_form_offers', function (Blueprint $table) {
            $table->foreignId('referral_partner_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_form_offers', function (Blueprint $table) {
            $table->dropForeign(['referral_partner_id']);
            $table->dropColumn('referral_partner_id');
        });
    }
};
