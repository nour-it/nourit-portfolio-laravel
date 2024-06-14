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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('project_categories');
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->text("description")->nullable();
            $table->dateTime("create_at")->nullable();
            $table->dateTime("update_at")->nullable();
            $table->dateTime("delete_at")->nullable();
        });
        Schema::create('categorisables', function (Blueprint $table) {
            $table->id();
            $table->foreignid("category_id")->nullable()->references("id")->on("categories")->nullOnDelete();
            $table->foreignid("categorisable_id");
            $table->string("categorisable_type");
            $table->dateTime("add_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorisables');
    }
};
