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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('image')->nullable();
            $table->string('name')->comment('Team/Brokerage name');
            $table->string('code')->comment('Team/Brokerage code');
            $table->unsignedInteger('no_of_agents')->default(0)->comment('No. of agents allowed in Team/Brokerage');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('address');
            $table->text('notes')->nullable();
            $table->boolean('personal_team');
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
        Schema::dropIfExists('teams');
    }
};
