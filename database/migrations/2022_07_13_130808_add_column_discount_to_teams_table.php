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
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedInteger('total_agents')->nullable();
            $table->unsignedInteger('price_per_agent')->nullable();
            $table->unsignedInteger('discount_per_month')->default(0);
            $table->unsignedInteger('discount_per_year')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['price_per_agent', 'discount_per_month', 'discount_per_year']);
        });
    }
};
