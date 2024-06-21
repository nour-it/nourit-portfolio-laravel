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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->string('confirmation_token')->nullable(true);
            $table->string('delete_token')->nullable(true);
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->string('ip')->nullable();
            $table->dateTime('create_at')->nullable();
            $table->dateTime('update_at')->nullable();
            $table->dateTime('validate_at')->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->dateTime('lastlogin_at')->nullable();
            $table->text('bio')->nullable();
            $table->text('about')->nullable();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignid("user_id")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->foreignid("role_id")->nullable()->references("id")->on("roles")->nullOnDelete();
            $table->dateTime('add_at')->nullable();
        });

        Schema::table("projects", function (Blueprint $table) {
            $table->foreignid("user_id")->nullable()->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
