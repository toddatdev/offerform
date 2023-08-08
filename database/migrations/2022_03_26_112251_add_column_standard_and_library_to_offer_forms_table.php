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
        Schema::table('offer_forms', function (Blueprint $table) {
            $table->boolean('standard')->default(false);
            $table->boolean('library')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_forms', function (Blueprint $table) {
            $table->dropColumn(['standard', 'library']);
        });
    }
};
