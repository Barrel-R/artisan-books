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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->longText("long_description");
            $table->string("gender");
            $table->decimal("price");
            $table->string("age_range");
            $table->string("page_count");
            $table->string("materials")->nullable();
            $table->string("dimensions")->nullable();
            $table->string("manufacturing_time")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
