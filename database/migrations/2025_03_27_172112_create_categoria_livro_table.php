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
        Schema::create('categoria_livro', function (Blueprint $table) {
            $table->id();
            $table->foreignId("livro_id")->constrained()->onDelete("cascade");
            $table->foreignId("categoria_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("categoria_livro", function (Blueprint $table) {
            $table->dropForeign(["livro_id", "categoria_id"]);
        });
        Schema::dropIfExists('categoria_livro');
    }
};
