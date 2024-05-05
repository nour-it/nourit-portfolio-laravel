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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string("path");
        });
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("add_at");
            $table->dateTime("delete_at")->nullable();
            $table->text("description")->nullable();
        });
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("add_at");
            $table->dateTime("delete_at")->nullable();
            $table->text("description")->nullable();
            $table->foreignid("skill_category_id")->nullable()->references("id")->on("skill_categories");
        });
        Schema::create('image_skill', function (Blueprint $table) {
            $table->foreignid("image_id")->nullable()->references("id")->on("images")->nullOnDelete();
            $table->foreignid("skill_id")->nullable()->references("id")->on("skills")->nullOnDelete();
            $table->dateTime("upload_at");
            $table->dateTime("delete_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_skill');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('images');
    }
};
