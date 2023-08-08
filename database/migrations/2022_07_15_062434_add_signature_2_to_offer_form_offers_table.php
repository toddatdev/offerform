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
            $table->string('signature_2')->nullable()->after('signature');
            $table->dateTime('signed_at_2')->nullable();
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
            $table->dropColumn('signature_2');
            $table->dropColumn('signed_at_2');
        });
    }
};
