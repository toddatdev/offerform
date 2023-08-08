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
        Schema::create('offer_form_submitted_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_form_offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('offer_form_id')->comment('Offer Form Step')->constrained()->onDelete('cascade');
            $table->foreignId('offer_form_section_id')->nullable()->constrained()->onDelete('set null');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('type');
            $table->json('type_config');
            $table->json('user_response');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedSmallInteger('display_order');
            $table->boolean('required')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_form_submitted_sections');
    }
};
