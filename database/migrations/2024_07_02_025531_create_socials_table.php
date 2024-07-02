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
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("add_at")->nullable();
            $table->dateTime("remove_at")->nullable();
        });

        Schema::create('social_user', function (Blueprint $table) {
            $table->id();
            $table->string("link");
            $table->string("type")->nullable();
            $table->foreignid("user_id")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->foreignid("social_id")->nullable()->references("id")->on("socials")->nullOnDelete();
            $table->dateTime("add_at")->nullable();
            $table->dateTime("remove_at")->nullable();
        });

        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string("path");
            $table->dateTime("add_at")->nullable();
            $table->dateTime("remove_at")->nullable();
            $table->foreignid("user_id")->nullable()->references("id")->on("users")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('social_user');
        Schema::dropIfExists('socials');
    }
};
