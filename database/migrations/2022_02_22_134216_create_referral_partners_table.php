<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('referral_partner_type_id')->nullable()->constrained()->onDelete('cascade');;
            $table->string('name');
            $table->string('image');
            $table->string('company_name');
            $table->string('company_phone');
            $table->string('company_email')->nullable();
            $table->string('company_website')->nullable();
            $table->string('billing_plan')->nullable();
            $table->string('video')->nullable();
            $table->text('company_bio')->nullable();
            $table->string('logo')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_zip_code')->nullable();
            $table->date('first_service_date')->nullable();
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
        Schema::dropIfExists('referral_partners');
    }
};
