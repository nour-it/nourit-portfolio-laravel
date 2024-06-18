<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description")->nullable();
            $table->dateTime("create_at")->nullable();
            $table->dateTime("update_at")->nullable();
            $table->dateTime("desable_at")->nullable();
            $table->dateTime("active_at")->nullable();
            $table->foreignid("user_id")->nullable()->references("id")->on("users")->nullOnDelete();
        });
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->dateTime("create_at")->nullable();
            $table->dateTime("update_at")->nullable();
            $table->dateTime("desable_at")->nullable();
            $table->dateTime("active_at")->nullable();
            $table->foreignid("user_id")->nullable()->references("id")->on("users")->nullOnDelete();
        });
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("country");
            $table->string("city");
            $table->foreignid("qualification_id")->nullable()->references("id")->on("qualifications")->nullOnDelete();
        });
        Schema::table('qualifications', function (Blueprint $table) {
            $table->foreignid("address_id")->nullable()->references("id")->on("addresses")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('qualifications');
        Schema::dropIfExists('addresses');
    }
};
