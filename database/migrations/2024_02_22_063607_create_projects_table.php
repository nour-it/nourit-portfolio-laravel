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
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("add_at");
            $table->dateTime("delete_at")->nullable();
            $table->text("description")->nullable();
        });
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("add_at");
            $table->dateTime("delete_at")->nullable();
            $table->text("description")->nullable();
            $table->foreignid("project_category_id")->nullable()->references("id")->on("project_categories");
        });
        Schema::create('image_project', function (Blueprint $table) {
            $table->foreignid("image_id")->nullable()->references("id")->on("images");
            $table->foreignid("project_id")->nullable()->references("id")->on("projects");
            $table->dateTime("upload_at")->default(now());
            $table->dateTime("delete_at")->nullable();
        });
        Schema::create('project_skill', function (Blueprint $table) {
            $table->foreignid("skill_id")->nullable()->references("id")->on("skills");
            $table->foreignid("project_id")->nullable()->references("id")->on("projects");
            $table->dateTime("link_at")->default(now());
            $table->dateTime("delete_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_image');
        Schema::dropIfExists('project_skill');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_categories');
    }
};
