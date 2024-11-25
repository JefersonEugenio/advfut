<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('clube', 100);
            $table->string('imagem');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->tinyInteger('avaliacao_nota')->nullable()->default(0)->check('avaliacao_nota >= 0 and avaliacao_nota <= 5');
            $table->text('avaliacao_comentarios')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }

};