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
        Schema::create('imageables', function (Blueprint $table) {
            $table->foreignid("image_id")->nullable()->references("id")->on("images");
            $table->foreignid("imageable_id");
            $table->string("imageable_type");
            $table->dateTime("add_at")->nullable();
            $table->dateTime("update_at")->nullable();
            $table->dateTime("delete_at")->nullable();  $table->id();
        });

        Schema::dropIfExists("image_project");
        Schema::dropIfExists("image_skill");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imageables');
    }
};
