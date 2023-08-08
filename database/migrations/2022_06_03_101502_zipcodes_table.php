<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        \DB::unprepared(file_get_contents(database_path('zipcodes/zipcodes-table.sql')));
//        \DB::unprepared(file_get_contents(database_path('zipcodes/zipcodes-data.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zipcodes');
    }
};
