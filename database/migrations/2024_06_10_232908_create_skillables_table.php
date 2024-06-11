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
        Schema::create('skillables', function (Blueprint $table) {
            $table->id();
            $table->foreignid("skill_id")->nullable()->references("id")->on("skills");
            $table->foreignid("skillable_id");
            $table->string("skillable_type");
            $table->dateTime("add_at")->nullable();
            $table->dateTime("update_at")->nullable();
            $table->dateTime("delete_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skillables');
    }
};
