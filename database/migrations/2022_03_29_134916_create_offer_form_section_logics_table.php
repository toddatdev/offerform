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
        Schema::create('offer_form_section_logics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_form_section_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->unsignedInteger('display_order');
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
        Schema::dropIfExists('offer_form_section_logics');
    }
};
