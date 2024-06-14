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
            $table->id();
            $table->foreignid("image_id")->nullable()->references("id")->on("images")->nullOnDelete();
            $table->foreignid("imageable_id");
            $table->string("imageable_type");
            $table->dateTime("upload_at")->nullable();
            $table->dateTime("delete_at")->nullable();  
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
