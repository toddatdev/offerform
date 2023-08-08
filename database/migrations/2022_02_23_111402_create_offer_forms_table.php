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
        Schema::create('offer_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('offer_forms')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('display_order');
            $table->boolean('active')->default(false);
            $table->boolean('locked')->default(true);
            $table->timestamp('last_opened_at')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('last_updated_by_id')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('offer_forms');
    }
};
