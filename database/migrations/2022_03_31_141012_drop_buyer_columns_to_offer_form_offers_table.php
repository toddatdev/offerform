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
            $table->dropColumn(['name', 'closing_at', 'property_address', 'additional_name']);
            $table->json('variables')->nullable()->after('accepted');
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
            $table->dropColumn(['variables']);
            $table->string('property_address')->nullable();
            $table->string('name')->nullable();
            $table->string('additional_name')->nullable();
            $table->date('closing_at')->nullable();
        });
    }
};
